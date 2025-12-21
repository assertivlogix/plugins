<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PluginSubscription;
use App\Models\License;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Renew a subscription
     */
    public function renew(Request $request)
    {
        try {
            $validated = $request->validate([
                'subscription_id' => 'required|exists:plugin_subscriptions,id',
                'renewal_period' => 'required|in:monthly,yearly,lifetime',
                'amount' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'notes' => 'nullable|string|max:500'
            ]);

            $subscription = PluginSubscription::findOrFail($validated['subscription_id']);
            
            // Create a new subscription for the renewal
            $newSubscription = PluginSubscription::create([
                'user_id' => $subscription->user_id,
                'product_id' => $subscription->product_id,
                'plan' => $validated['renewal_period'],
                'amount' => $validated['amount'],
                'currency' => $subscription->currency,
                'status' => 'active',
                'starts_at' => Carbon::parse($validated['start_date']),
                'expires_at' => Carbon::parse($validated['end_date']),
                'stripe_subscription_id' => null, // Admin renewal, no Stripe
                'stripe_payment_intent_id' => null,
            ]);

            // Generate a new license for the renewed subscription
            $license = License::create([
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
            \Log::info('Subscription renewed by admin', [
                'old_subscription_id' => $subscription->id,
                'new_subscription_id' => $newSubscription->id,
                'user_id' => $subscription->user_id,
                'product_id' => $subscription->product_id,
                'plan' => $validated['renewal_period'],
                'amount' => $validated['amount'],
                'admin_id' => auth()->id(),
                'notes' => $validated['notes'] ?? null
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription renewed successfully! New license key has been generated.',
                'new_subscription_id' => $newSubscription->id,
                'license_key' => $license->license_key
            ]);

        } catch (\Exception $e) {
            \Log::error('Subscription renewal failed', [
                'subscription_id' => $request->subscription_id,
                'error' => $e->getMessage(),
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to renew subscription: ' . $e->getMessage()
            ], 500);
        }
    }
}
