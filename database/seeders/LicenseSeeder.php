<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\License;
use App\Models\PluginSubscription;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing licenses to avoid duplicates
        License::query()->delete();

        // Get all subscriptions
        $subscriptions = PluginSubscription::all();

        foreach ($subscriptions as $subscription) {
            // Create a license for each subscription
            License::create([
                'subscription_id' => $subscription->id,
                'license_key' => $this->generateLicenseKey(),
                'activation_limit' => $subscription->plan === 'yearly' ? 5 : 3,
                'created_at' => $subscription->created_at,
                'updated_at' => $subscription->created_at,
            ]);
        }

        $this->command->info('Created licenses for all subscriptions.');
    }

    private function generateLicenseKey()
    {
        // Generate a license key in format: XXXX-XXXX-XXXX-XXXX
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 4) . '-' .
                        substr(md5(uniqid(rand(), true)), 4, 4) . '-' .
                        substr(md5(uniqid(rand(), true)), 8, 4) . '-' .
                        substr(md5(uniqid(rand(), true)), 12, 4));
    }
}
