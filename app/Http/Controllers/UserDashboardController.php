<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\PluginSubscription;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        try {
            // Get user's transactions and subscriptions with error handling
            $transactions = \App\Models\Transaction::where('user_id', $user->id)
                ->with(['user', 'license', 'subscription', 'product'])
                ->latest('created_at')
                ->get();

            $subscriptions = \App\Models\PluginSubscription::where('user_id', $user->id)
                ->with(['product', 'license'])
                ->latest()
                ->get();

            $licenses = \App\Models\License::whereHas('subscription', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['subscription.product'])->get();

            // Calculate stats using transactions (like billing history)
            $totalSpent = $transactions->where('status', 'completed')->sum('amount');
            $thisMonthSpent = $transactions->where('status', 'completed')
                ->where('created_at', '>=', now()->startOfMonth())
                ->sum('amount');
            
            // Calculate purchase and renewal amounts using transactions
            $purchaseAmount = $transactions->where('status', 'completed')
                ->where('type', 'purchase')
                ->sum('amount');
            $renewalAmount = $transactions->where('status', 'completed')
                ->where('type', 'renewal')
                ->sum('amount');
            
            // Backup calculation using subscription data if transaction types are not set
            if ($purchaseAmount == 0 && $renewalAmount == 0) {
                $subscriptionsByProduct = $subscriptions->groupBy('product_id');
                $purchaseAmount = 0;
                $renewalAmount = 0;
                
                foreach ($subscriptionsByProduct as $productId => $productSubscriptions) {
                    $sortedSubscriptions = $productSubscriptions->sortBy('created_at');
                    if ($sortedSubscriptions->isNotEmpty()) {
                        $firstSubscription = $sortedSubscriptions->first();
                        $purchaseAmount += $firstSubscription->amount ?? 0;
                        $renewalSubscriptions = $sortedSubscriptions->slice(1);
                        foreach ($renewalSubscriptions as $renewal) {
                            $renewalAmount += $renewal->amount ?? 0;
                        }
                    }
                }
            }
            
            $finalPurchaseAmount = $purchaseAmount;
            $finalRenewalAmount = $renewalAmount;

            // Calculate subscription stats
            $totalSubscriptions = $subscriptions->count() ?? 0;
            $activeSubscriptions = $subscriptions->where('status', 'active')->count() ?? 0;
            $totalLicenses = $licenses->count() ?? 0;
            $activeLicenses = $licenses->filter(function($license) {
                return $license->subscription && 
                       $license->subscription->status === 'active' && 
                       (!$license->subscription->expires_at || $license->subscription->expires_at->isFuture());
            })->count() ?? 0;

            // Recent subscriptions (same as subscriptions but for display)
            $recentSubscriptions = $subscriptions;

            // Expiring soon subscriptions
            $expiringSoon = $subscriptions->filter(function($subscription) {
                return $subscription->expires_at && 
                       $subscription->expires_at->isFuture() && 
                       $subscription->expires_at->diffInDays(now()) <= 30;
            });

            // Build recent activity from actual data
            $recentActivity = collect();
            
            // Add subscription activities
            foreach ($subscriptions->take(3) as $subscription) {
                $recentActivity->push([
                    'type' => 'purchase',
                    'title' => 'Purchased ' . ($subscription->product->name ?? 'Plugin'),
                    'description' => ucfirst($subscription->plan ?? 'Standard') . ' plan - $' . number_format($subscription->amount ?? 0, 2),
                    'time' => $subscription->created_at ? $subscription->created_at->diffForHumans() : 'Recently',
                    'icon' => 'shopping-cart'
                ]);
            }
            
            // Add license activities
            foreach ($licenses->take(2) as $license) {
                $recentActivity->push([
                    'type' => 'download',
                    'title' => 'Downloaded License Key',
                    'description' => 'For ' . ($license->subscription->product->name ?? 'Plugin'),
                    'time' => $license->created_at ? $license->created_at->diffForHumans() : 'Recently',
                    'icon' => 'download'
                ]);
            }
            
            // Add profile update activity
            if ($user->updated_at && $user->updated_at->diffInDays(now()) <= 7) {
                $recentActivity->push([
                    'type' => 'profile',
                    'title' => 'Updated Profile',
                    'description' => 'Updated your profile information',
                    'time' => $user->updated_at->diffForHumans(),
                    'icon' => 'user'
                ]);
            }

            // Build recent downloads from actual licenses
            $recentDownloads = collect();
            foreach ($licenses->take(5) as $license) {
                $recentDownloads->push([
                    'name' => $license->subscription->product->name ?? 'Unknown Plugin',
                    'version' => 'Latest',
                    'date' => $license->created_at->format('Y-m-d'),
                    'size' => '1.5 MB',
                    'time' => $license->created_at->diffForHumans(),
                    'license_key' => $license->license_key
                ]);
            }

            // Billing information
            $nextPayment = $subscriptions->where('status', 'active')->first();
            $lastPayment = $subscriptions->sortByDesc('created_at')->first();

            // Billing history - all subscriptions as billing transactions
            $billingHistory = $subscriptions->map(function($subscription) {
                return [
                    'id' => $subscription->id,
                    'description' => $subscription->product->name ?? 'Unknown Product',
                    'plan' => ucfirst($subscription->plan ?? 'Standard'),
                    'amount' => $subscription->amount,
                    'status' => $subscription->status,
                    'date' => $subscription->created_at,
                    'next_billing' => $subscription->expires_at,
                    'payment_method' => 'Credit Card', // Default payment method
                    'transaction_id' => 'TXN-' . str_pad($subscription->id, 6, '0', STR_PAD_LEFT),
                    'type' => $subscription->status === 'active' ? 'subscription' : 'payment'
                ];
            })->sortByDesc('date');

            return view('user.dashboard', compact(
                'user',
                'subscriptions',
                'licenses',
                'transactions',
                'totalSpent',
                'thisMonthSpent',
                'totalSubscriptions',
                'activeSubscriptions',
                'totalLicenses',
                'activeLicenses',
                'recentSubscriptions',
                'expiringSoon',
                'recentActivity',
                'recentDownloads',
                'nextPayment',
                'lastPayment',
                'billingHistory',
                'finalPurchaseAmount',
                'finalRenewalAmount'
            ));
        } catch (\Exception $e) {
            // Log error and return with basic data
            \Log::error('Dashboard error: ' . $e->getMessage());
            
            // Return basic data to prevent errors
            return view('user.dashboard', [
                'user' => $user,
                'subscriptions' => collect(),
                'licenses' => collect(),
                'transactions' => collect(),
                'totalSpent' => 0,
                'thisMonthSpent' => 0,
                'totalSubscriptions' => 0,
                'activeSubscriptions' => 0,
                'totalLicenses' => 0,
                'activeLicenses' => 0,
                'recentSubscriptions' => collect(),
                'expiringSoon' => collect(),
                'recentActivity' => collect(),
                'recentDownloads' => collect(),
                'nextPayment' => null,
                'lastPayment' => null,
                'billingHistory' => collect(),
                'finalPurchaseAmount' => 0,
                'finalRenewalAmount' => 0
            ])->with('error', 'Some dashboard features may not be available.');
        }
    }

    public function billingHistory()
    {
        $user = auth()->user();
        
        try {
            // Get all transactions for the user
            $transactions = Transaction::where('user_id', $user->id)
                ->with(['user', 'license', 'subscription', 'product'])
                ->latest('created_at')
                ->get();

            // Transform transactions for display
            $billingHistory = $transactions->map(function($transaction) {
                return [
                    'id' => $transaction->transaction_id,
                    'description' => $transaction->description ?? $transaction->product_name,
                    'plan' => ucfirst($transaction->plan),
                    'amount' => $transaction->amount,
                    'status' => $transaction->status,
                    'date' => $transaction->created_at,
                    'type' => $transaction->type,
                    'payment_method' => $transaction->payment_method,
                    'transaction_id' => $transaction->transaction_id,
                    'invoice_url' => route('user.invoices.download', $transaction->transaction_id),
                    'receipt_url' => '#', // Placeholder for receipt download
                    'metadata' => [
                        'license_key' => $transaction->license_key,
                        'product_id' => $transaction->product_id,
                        'subscription_id' => $transaction->subscription_id,
                        'license_id' => $transaction->license_id,
                        'billing_name' => $transaction->billing_name,
                        'billing_email' => $transaction->billing_email,
                        'period_start' => $transaction->period_start ? $transaction->period_start->format('M d, Y') : null,
                        'period_end' => $transaction->period_end ? $transaction->period_end->format('M d, Y') : null,
                        'original_amount' => $transaction->original_amount,
                        'discount_amount' => $transaction->discount_amount,
                        'discount_code' => $transaction->discount_code,
                        'currency' => $transaction->currency,
                        'failure_reason' => $transaction->metadata['failure_reason'] ?? null,
                        'requires_action' => $transaction->metadata['requires_action'] ?? false,
                    ]
                ];
            });

            // Calculate billing statistics
            $totalSpent = $transactions->where('status', 'completed')->sum('amount');
            $thisYearSpent = $transactions->where('status', 'completed')
                ->where('created_at', '>=', now()->startOfYear())
                ->sum('amount');
            $thisMonthSpent = $transactions->where('status', 'completed')
                ->where('created_at', '>=', now()->startOfMonth())
                ->sum('amount');
            $activeSubscriptions = PluginSubscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->count();
            $totalTransactions = $transactions->count();
            $renewalCount = $transactions->where('type', 'renewal')->count();
            $purchaseCount = $transactions->where('type', 'purchase')->count();

            return view('user.billing-history', compact(
                'user',
                'billingHistory',
                'totalSpent',
                'thisYearSpent',
                'thisMonthSpent',
                'activeSubscriptions',
                'totalTransactions',
                'renewalCount',
                'purchaseCount'
            ));
        } catch (\Exception $e) {
            \Log::error('Billing history error: ' . $e->getMessage());
            return view('user.billing-history', [
                'user' => $user,
                'billingHistory' => collect(),
                'totalSpent' => 0,
                'thisYearSpent' => 0,
                'thisMonthSpent' => 0,
                'activeSubscriptions' => 0,
                'totalTransactions' => 0,
                'renewalCount' => 0,
                'purchaseCount' => 0
            ]);
        }
    }

    public function licenses()
    {
        $user = auth()->user();
        
        $licenses = License::whereHas('subscription', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['subscription.product', 'subscription'])
        ->latest()
        ->paginate(10);

        return view('user.licenses', compact('licenses'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'company' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'timezone' => 'nullable|string|max:50',
                'bio' => 'nullable|string|max:1000',
                'website' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'postal_code' => 'nullable|string|max:20',
                'linkedin' => 'nullable|string|max:255',
                'twitter' => 'nullable|string|max:255',
                'facebook' => 'nullable|string|max:255',
                'instagram' => 'nullable|string|max:255',
                'email_notifications' => 'nullable|boolean',
                'security_alerts' => 'nullable|boolean',
                'marketing_emails' => 'nullable|boolean',
                'product_updates' => 'nullable|boolean',
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'company' => $request->company,
                'phone' => $request->phone,
                'timezone' => $request->timezone,
                'bio' => $request->bio,
                'website' => $request->website,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
                'linkedin' => $request->linkedin,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'email_notifications' => $request->input('email_notifications') == '1',
                'security_alerts' => $request->input('security_alerts') == '1',
                'marketing_emails' => $request->input('marketing_emails') == '1',
                'product_updates' => $request->input('product_updates') == '1',
            ]);

            return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred while updating your profile. Please try again.')
                ->withInput();
        }
    }

    /**
     * Get initial purchase transaction details for a license
     */
    public function getInitialPurchase($licenseId)
    {
        $user = auth()->user();
        
        try {
            $license = License::whereHas('subscription', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['subscription.product', 'subscription'])
            ->findOrFail($licenseId);

            // Get the initial transaction for this subscription
            $initialTransaction = Transaction::where('subscription_id', $license->subscription->id)
                ->where('status', 'completed')
                ->orderBy('created_at', 'asc')
                ->first();

            if (!$initialTransaction) {
                return response()->json([
                    'success' => false,
                    'message' => 'No initial purchase transaction found'
                ]);
            }

            return response()->json([
                'success' => true,
                'transaction' => [
                    'id' => $initialTransaction->id,
                    'amount' => $initialTransaction->amount,
                    'currency' => $initialTransaction->currency ?? 'USD',
                    'payment_method' => $initialTransaction->payment_method ?? 'stripe',
                    'status' => $initialTransaction->status,
                    'created_at' => $initialTransaction->created_at,
                    'transaction_id' => $initialTransaction->transaction_id,
                    'product_name' => $license->subscription->product->name,
                    'plan' => $license->subscription->plan,
                    'billing_cycle' => $license->subscription->plan,
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Error getting initial purchase: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load purchase details'
            ], 500);
        }
    }
    /**
     * Download/View Invoice
     */
    public function downloadInvoice($transactionId)
    {
        $user = auth()->user();
        
        $transaction = Transaction::where('user_id', $user->id)
            ->where('transaction_id', $transactionId)
            ->firstOrFail();
            
        return view('user.invoice', compact('transaction'));
    }
}
