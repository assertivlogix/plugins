<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PluginSubscription;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing subscriptions to avoid duplicates
        PluginSubscription::query()->delete();

        // Get the admin user and any existing products
        $adminUser = User::where('email', 'admin@example.com')->first();
        $products = Product::all();

        if ($adminUser && $products->count() > 0) {
            // Create sample subscriptions for the admin user
            foreach ($products as $index => $product) {
                // Create monthly subscription
                PluginSubscription::create([
                    'user_id' => $adminUser->id,
                    'product_id' => $product->id,
                    'plan' => 'monthly',
                    'amount' => $product->price_monthly ?: 9.99,
                    'currency' => 'USD',
                    'status' => 'active',
                    'starts_at' => Carbon::now()->subDays(rand(1, 30)),
                    'expires_at' => Carbon::now()->addMonth(),
                    'stripe_subscription_id' => 'sub_monthly_' . uniqid(),
                    'stripe_payment_intent_id' => 'pi_monthly_' . uniqid(),
                ]);

                // Create yearly subscription
                PluginSubscription::create([
                    'user_id' => $adminUser->id,
                    'product_id' => $product->id,
                    'plan' => 'yearly',
                    'amount' => $product->price_yearly ?: 99.99,
                    'currency' => 'USD',
                    'status' => 'active',
                    'starts_at' => Carbon::now()->subDays(rand(1, 30)),
                    'expires_at' => Carbon::now()->addYear(),
                    'stripe_subscription_id' => 'sub_yearly_' . uniqid(),
                    'stripe_payment_intent_id' => 'pi_yearly_' . uniqid(),
                ]);
            }

            // Create some historical subscriptions for revenue data
            for ($i = 1; $i <= 6; $i++) {
                $product = $products->random();
                PluginSubscription::create([
                    'user_id' => $adminUser->id,
                    'product_id' => $product->id,
                    'plan' => 'monthly',
                    'amount' => $product->price_monthly ?: 9.99,
                    'currency' => 'USD',
                    'status' => 'cancelled',
                    'starts_at' => Carbon::now()->subMonths($i),
                    'expires_at' => Carbon::now()->subMonths($i - 1),
                    'stripe_subscription_id' => 'sub_cancelled_' . uniqid(),
                    'stripe_payment_intent_id' => 'pi_cancelled_' . uniqid(),
                ]);
            }

            $this->command->info('Created sample subscriptions with revenue data.');
        } else {
            $this->command->error('No admin user or products found. Please seed those first.');
        }
    }
}
