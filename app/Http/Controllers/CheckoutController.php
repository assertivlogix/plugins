<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseReceipt;
use App\Mail\PurchaseNotification;

class CheckoutController extends Controller
{
    public function create(Request $request, Product $product)
    {
        $plan = $request->get('plan', 'monthly'); // 'monthly' or 'yearly'
        $isRenewal = $request->get('renewal', false);
        $renewalAmount = $request->get('amount');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        // Get renewal data from session if available
        $renewalData = session('renewal_checkout_data');
        
        // Debug: Log product data
        \Log::info('Checkout Product Data', [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price_monthly' => $product->price_monthly,
            'price_yearly' => $product->price_yearly,
            'plan' => $plan,
            'is_renewal' => $isRenewal,
            'renewal_amount' => $renewalAmount,
            'renewal_data' => $renewalData
        ]);
        
        // Calculate pricing
        if ($isRenewal && $renewalAmount) {
            // Use renewal amount
            $price = $renewalAmount;
            $originalPrice = null;
            $discount = null;
        } else {
            // Standard pricing calculation
            if ($plan === 'yearly') {
                $price = $product->price_yearly ?? ($product->price_monthly * 10); // 2 months free
                $originalPrice = $product->price_monthly * 12;
                $discount = $originalPrice - $price;
            } else {
                $price = $product->price_monthly;
                $originalPrice = null;
                $discount = null;
            }
        }

        return view('checkout.create', compact(
            'product',
            'plan',
            'price',
            'originalPrice',
            'discount',
            'isRenewal',
            'renewalData',
            'startDate',
            'endDate'
        ));
    }

    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'plan' => 'required|in:monthly,yearly',
        ]);

        $product = Product::findOrFail($request->product_id);
        $plan = $request->plan;
        $user = auth()->user();

        try {
            // Calculate amount in cents (paise for INR)
            // Note: Razorpay supports international currencies, but let's assume USD for now or convert if needed.
            // If using USD, Razorpay still expects amount in smallest unit (cents).
            $amount = $plan === 'yearly' ? 
                ($product->price_yearly ?? $product->price_monthly * 10) * 100 : 
                $product->price_monthly * 100;

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $orderData = [
                'receipt'         => 'rcpt_' . Transaction::generateTransactionId(),
                'amount'          => $amount,
                'currency'        => 'USD',
                'payment_capture' => 1 // Auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'key' => config('services.razorpay.key'),
                'amount' => $amount,
                'currency' => 'USD',
                'name' => 'Assertivlogix',
                'description' => "Payment for {$product->name} - {$plan} plan",
                'prefill' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'contact' => $user->phone ?? '',
                ],
                'notes' => [
                    'product_id' => $product->id,
                    'plan' => $plan,
                    'user_id' => $user->id,
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay Order Creation Error', [
                'error' => $e->getMessage(),
                'product_id' => $product->id,
                'plan' => $plan,
                'user_id' => auth()->id(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Order creation failed: ' . $e->getMessage()
            ], 400);
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'product_id' => 'required|exists:products,id',
            'plan' => 'required|in:monthly,yearly',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Payment is verified
            $product = Product::findOrFail($request->product_id);
            $plan = $request->plan;
            $user = auth()->user();
            
            // Calculate amount again for record keeping
            $amount = $plan === 'yearly' ? 
                ($product->price_yearly ?? $product->price_monthly * 10) : 
                $product->price_monthly;

            // Create subscription record
            $subscription = \App\Models\PluginSubscription::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'plan' => $plan,
                'amount' => $amount,
                'currency' => 'USD',
                'status' => 'active',
                'starts_at' => now(),
                'expires_at' => $plan === 'yearly' ? now()->addYear() : now()->addMonth(),
                'stripe_subscription_id' => $request->razorpay_order_id, // Storing Razorpay Order ID here for reference
                'stripe_payment_intent_id' => $request->razorpay_payment_id, // Storing Payment ID
                'stripe_customer_id' => 'razorpay_customer', // Placeholder
            ]);

            // Create license for the user
            $license = \App\Models\License::create([
                'subscription_id' => $subscription->id,
                'license_key' => $this->generateLicenseKey(),
                'activation_limit' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create transaction record
            Transaction::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'purchase',
                'status' => 'completed',
                'amount' => $amount,
                'currency' => 'USD',
                'payment_method' => 'razorpay',
                'payment_gateway_transaction_id' => $request->razorpay_payment_id,
                'payment_gateway_customer_id' => 'razorpay_customer',
                'payment_metadata' => [
                    'order_id' => $request->razorpay_order_id,
                    'signature' => $request->razorpay_signature
                ],
                'product_name' => $product->name,
                'plan' => $plan,
                'original_amount' => $amount,
                'discount_amount' => 0,
                'license_key' => $license->license_key,
                'period_start' => now(),
                'period_end' => $plan === 'yearly' ? now()->addYear() : now()->addMonth(),
                'auto_renewal' => false,
                'billing_name' => $user->name,
                'billing_email' => $user->email,
                'description' => "Purchase of {$product->name} - {$plan} plan",
                'metadata' => [],
                'processed_at' => now(),
            ]);

            // Send Purchase Receipt Email to User
            try {
                Mail::to($user->email)->send(new PurchaseReceipt($user, $subscription, $license));
            } catch (\Exception $e) {
                \Log::error('Failed to send purchase receipt email', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id
                ]);
            }

            // Send Purchase Notification Email to Sales Team
            try {
                Mail::to('sales@assertivlogix.com')->send(new PurchaseNotification($user, $subscription, $license, $product));
            } catch (\Exception $e) {
                \Log::error('Failed to send purchase notification email to sales', [
                    'error' => $e->getMessage(),
                    'user_id' => $user->id
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Payment successful! Your subscription is now active.',
                'redirect' => route('checkout.success')
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay Verification Error', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }

    public function success(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            \Log::info('Checkout Success Page - Unauthenticated User', [
                'request_data' => $request->all(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            
            // Show a generic success page for unauthenticated users
            return view('checkout.success', [
                'subscription' => null,
                'license' => null,
                'product' => null,
                'unauthenticated' => true
            ]);
        }
        
        // Debug: Log the user and their subscriptions
        \Log::info('Checkout Success Page', [
            'user_id' => auth()->id(),
            'user_email' => auth()->user()->email,
            'request_data' => $request->all()
        ]);
        
        // Get the latest subscription for the current user
        $subscription = \App\Models\PluginSubscription::where('user_id', auth()->id())
            ->with(['product', 'licenses'])
            ->orderBy('created_at', 'desc')
            ->first();

        \Log::info('Subscription lookup result', [
            'subscription_found' => $subscription ? true : false,
            'subscription_id' => $subscription ? $subscription->id : null,
            'subscription_data' => $subscription ? [
                'product_id' => $subscription->product_id,
                'plan' => $subscription->plan,
                'amount' => $subscription->amount,
                'status' => $subscription->status,
                'created_at' => $subscription->created_at,
                'licenses_count' => $subscription->licenses ? $subscription->licenses->count() : 0
            ] : null
        ]);

        // If no subscription found, try to get the most recent transaction and work backwards
        if (!$subscription) {
            \Log::info('No subscription found, checking transactions...');
            
            $transaction = \App\Models\Transaction::where('user_id', auth()->id())
                ->where('status', 'completed')
                ->orderBy('created_at', 'desc')
                ->first();
                
            if ($transaction) {
                \Log::info('Found transaction, looking for subscription', [
                    'transaction_id' => $transaction->id,
                    'subscription_id' => $transaction->subscription_id
                ]);
                
                if ($transaction->subscription_id) {
                    $subscription = \App\Models\PluginSubscription::find($transaction->subscription_id);
                    if ($subscription) {
                        $subscription->load(['product', 'licenses']);
                        \Log::info('Found subscription via transaction', [
                            'subscription_id' => $subscription->id
                        ]);
                    }
                }
            }
        }

        // Get the license for this subscription
        $license = $subscription ? $subscription->licenses->first() : null;

        \Log::info('Final data for success page', [
            'subscription' => $subscription ? [
                'id' => $subscription->id,
                'product_name' => $subscription->product ? $subscription->product->name : null,
                'plan' => $subscription->plan,
                'amount' => $subscription->amount
            ] : null,
            'license' => $license ? [
                'id' => $license->id,
                'license_key' => $license->license_key
            ] : null
        ]);

        return view('checkout.success', [
            'subscription' => $subscription,
            'license' => $license,
            'product' => $subscription ? $subscription->product : null,
            'unauthenticated' => false
        ]);
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }

    private function generateLicenseKey()
    {
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 16) . '-' . 
                         substr(md5(uniqid(rand(), true)), 0, 16));
    }
}
