<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\PluginSubscription;
use App\Models\Product;
use App\Models\RenewalHistory;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Razorpay\Api\Api;

class UserSubscriptionController extends Controller
{
    /**
     * Renew a subscription (user-facing) with direct payment processing
     */
    public function renew(Request $request)
    {
        try {
            // Handle JSON input for payment processing
            $data = $request->json()->all();
            
            $validated = $request->validate([
                'license_id' => 'required|exists:licenses,id',
                'subscription_id' => 'required|exists:plugin_subscriptions,id',
                'renewal_period' => 'required|in:monthly,yearly',
                'amount' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'payment_method' => 'required|string',
                'card_number' => 'required|string',
                'card_expiry' => 'required|string',
                'card_cvv' => 'required|string',
                'card_name' => 'required|string'
            ]);

            $license = License::findOrFail($validated['license_id']);
            $subscription = PluginSubscription::findOrFail($validated['subscription_id']);

            // Verify ownership
            if ($subscription->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only renew your own subscriptions.'
                ], 403);
            }

            // Verify license belongs to subscription
            if ($license->subscription_id !== $subscription->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid license-subscription relationship.'
                ], 400);
            }

            // Simulate payment processing (in real implementation, integrate with Stripe/PayPal)
            $paymentResult = $this->processPayment($validated);

            if (!$paymentResult['success']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment failed: ' . $paymentResult['error']
                ], 400);
            }

            // Create new subscription for the renewal
            $newSubscription = PluginSubscription::create([
                'user_id' => $subscription->user_id,
                'product_id' => $subscription->product_id,
                'plan' => $validated['renewal_period'],
                'amount' => $validated['amount'],
                'currency' => $subscription->currency ?? 'USD',
                'status' => 'active',
                'starts_at' => Carbon::parse($validated['start_date']),
                'expires_at' => Carbon::parse($validated['end_date']),
                'stripe_subscription_id' => $paymentResult['subscription_id'], // From payment processor
                'stripe_payment_intent_id' => $paymentResult['payment_intent_id'], // From payment processor
            ]);

            // Generate a new license for the renewed subscription
            $newLicense = License::create([
                'subscription_id' => $newSubscription->id,
                'license_key' => License::generate(),
                'activation_limit' => 5, // Default activation limit
            ]);

            // Update the old subscription status to 'renewed'
            $subscription->update([
                'status' => 'renewed',
                'expires_at' => Carbon::parse($validated['start_date'])->subDay() // End yesterday
            ]);

            // Log the renewal
            \Log::info('Subscription renewed by user with payment', [
                'old_subscription_id' => $subscription->id,
                'new_subscription_id' => $newSubscription->id,
                'new_license_id' => $newLicense->id,
                'user_id' => $subscription->user_id,
                'product_id' => $subscription->product_id,
                'plan' => $validated['renewal_period'],
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'transaction_id' => $paymentResult['transaction_id']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription renewed successfully! Your new license key has been generated.',
                'new_subscription_id' => $newSubscription->id,
                'new_license_key' => $newLicense->license_key,
                'transaction_id' => $paymentResult['transaction_id'],
                'expires_at' => $newSubscription->expires_at->format('M d, Y')
            ]);

        } catch (\Exception $e) {
            \Log::error('User subscription renewal failed', [
                'license_id' => $request->license_id,
                'subscription_id' => $request->subscription_id,
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to process renewal: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Create Razorpay Order for Renewal
     */
    public function createRenewalOrder(Request $request)
    {
        try {
            $validated = $request->validate([
                'license_id' => 'required|exists:licenses,id',
                'subscription_id' => 'required|exists:plugin_subscriptions,id',
                'renewal_period' => 'required|in:monthly,yearly',
                'amount' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            $license = License::findOrFail($validated['license_id']);
            $subscription = PluginSubscription::findOrFail($validated['subscription_id']);

            // Verify ownership
            if ($subscription->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only renew your own subscriptions.'
                ], 403);
            }

            // Calculate amount in cents (paise)
            $amount = $validated['amount'] * 100;

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $orderData = [
                'receipt'         => 'rcpt_renew_' . Transaction::generateTransactionId(),
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
                'description' => "Renewal for {$subscription->product->name} - {$validated['renewal_period']} plan",
                'prefill' => [
                    'name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                    'contact' => auth()->user()->phone ?? '',
                ],
                'notes' => [
                    'subscription_id' => $subscription->id,
                    'license_id' => $license->id,
                    'plan' => $validated['renewal_period'],
                    'user_id' => auth()->id(),
                    'renewal' => 'true',
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date']
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay Renewal Order Creation Error', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Order creation failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify Razorpay Renewal Payment
     */
    public function verifyRenewal(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'license_id' => 'required|exists:licenses,id',
            'subscription_id' => 'required|exists:plugin_subscriptions,id',
            'renewal_period' => 'required|in:monthly,yearly',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
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
            $license = License::findOrFail($request->license_id);
            $subscription = PluginSubscription::findOrFail($request->subscription_id);
            
            // Update the existing subscription
            $subscription->update([
                'plan' => $request->renewal_period,
                'amount' => $request->amount,
                'status' => 'active',
                'starts_at' => Carbon::parse($request->start_date),
                'expires_at' => Carbon::parse($request->end_date),
                'stripe_payment_intent_id' => $request->razorpay_payment_id, // Store Razorpay Payment ID
                'stripe_subscription_id' => $request->razorpay_order_id, // Store Razorpay Order ID
                'stripe_customer_id' => 'razorpay_customer',
            ]);

            // Create renewal history record
            RenewalHistory::createRenewalRecord($license, $subscription, [
                'plan' => $request->renewal_period,
                'amount' => $request->amount,
                'renewal_type' => 'extension',
                'transaction_id' => $request->razorpay_payment_id,
                'payment_method' => 'razorpay',
                'payment_intent_id' => $request->razorpay_payment_id,
                'customer_id' => 'razorpay_customer',
                'start_date' => Carbon::parse($request->start_date),
                'end_date' => Carbon::parse($request->end_date),
                'metadata' => [
                    'order_id' => $request->razorpay_order_id,
                    'renewal_initiated_at' => now()->toISOString(),
                ]
            ]);

            // Create transaction record
            Transaction::createRenewal([
                'user_id' => $subscription->user_id,
                'license_id' => $license->id,
                'subscription_id' => $subscription->id,
                'product_id' => $subscription->product_id,
                'product_name' => $subscription->product->name,
                'plan' => $request->renewal_period,
                'amount' => $request->amount,
                'currency' => $subscription->currency ?? 'USD',
                'start_date' => Carbon::parse($request->start_date),
                'end_date' => Carbon::parse($request->end_date),
                'license_key' => $license->license_key,
                'billing_name' => auth()->user()->name,
                'billing_email' => auth()->user()->email,
                'auto_renewal' => false,
                'metadata' => [
                    'order_id' => $request->razorpay_order_id,
                    'renewal_initiated_at' => now()->toISOString(),
                    'renewal_type' => 'extension',
                ]
            ], [
                'payment_method' => 'razorpay',
                'payment_intent_id' => $request->razorpay_payment_id,
                'customer_id' => 'razorpay_customer',
                'payment_metadata' => [
                    'order_id' => $request->razorpay_order_id,
                    'signature' => $request->razorpay_signature
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription renewed successfully! Your license has been extended.',
                'subscription_id' => $subscription->id,
                'license_key' => $license->license_key,
                'transaction_id' => $request->razorpay_payment_id,
                'expires_at' => $subscription->expires_at->format('M d, Y')
            ]);

        } catch (\Exception $e) {
            \Log::error('Razorpay Renewal Verification Error', [
                'error' => $e->getMessage(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed: ' . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get renewal history for a license
     */
    public function getRenewalHistory($licenseId)
    {
        try {
            $license = License::findOrFail($licenseId);
            
            // Verify ownership
            if ($license->subscription->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only view your own license renewal history.'
                ], 403);
            }

            $renewals = RenewalHistory::with(['user', 'license', 'subscription', 'product'])
                ->where('license_id', $licenseId)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'renewals' => $renewals->map(function ($renewal) {
                    return [
                        'id' => $renewal->id,
                        'plan' => $renewal->plan,
                        'amount' => $renewal->amount,
                        'renewal_type' => $renewal->renewal_type,
                        'transaction_id' => $renewal->transaction_id,
                        'payment_method' => $renewal->payment_method,
                        'renewal_start_date' => $renewal->renewal_start_date ? $renewal->renewal_start_date->format('M d, Y') : null,
                        'renewal_end_date' => $renewal->renewal_end_date ? $renewal->renewal_end_date->format('M d, Y') : null,
                        'created_at' => $renewal->created_at->toISOString(),
                        'notes' => $renewal->notes,
                    ];
                })
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to get renewal history', [
                'license_id' => $licenseId,
                'user_id' => auth()->id(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to load renewal history.'
            ], 500);
        }
    }


}
