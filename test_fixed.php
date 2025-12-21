<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "Testing after fix...\n";

$user = \App\Models\User::find(1);
echo "User: " . $user->name . "\n";

// Test subscription loading with fixed relationship
echo "\n=== Testing Fixed Subscription Loading ===\n";
$subscription = \App\Models\PluginSubscription::where('user_id', 1)
    ->with(['product', 'license'])
    ->first();

if ($subscription) {
    echo "Subscription found!\n";
    echo "ID: " . $subscription->id . "\n";
    echo "Amount: $" . $subscription->amount . "\n";
    echo "Status: " . $subscription->status . "\n";
    
    if ($subscription->product) {
        echo "Product: " . $subscription->product->name . "\n";
    } else {
        echo "Product NOT loaded\n";
    }
    
    if ($subscription->license) {
        echo "License Key: " . $subscription->license->license_key . "\n";
    } else {
        echo "License NOT loaded\n";
    }
} else {
    echo "No subscription found!\n";
}

// Test license loading
echo "\n=== Testing License Loading ===\n";
$license = \App\Models\License::whereHas('subscription', function($query) {
    $query->where('user_id', 1);
})->with(['subscription.product'])->first();

if ($license) {
    echo "License found!\n";
    echo "License Key: " . $license->license_key . "\n";
    
    if ($license->subscription) {
        echo "Subscription Amount: $" . $license->subscription->amount . "\n";
        
        if ($license->subscription->product) {
            echo "Product: " . $license->subscription->product->name . "\n";
        } else {
            echo "Product NOT loaded\n";
        }
    } else {
        echo "Subscription NOT loaded\n";
    }
} else {
    echo "No license found!\n";
}

// Test dashboard data
echo "\n=== Testing Dashboard Data ===\n";
$subscriptions = \App\Models\PluginSubscription::where('user_id', 1)
    ->with(['product', 'license'])
    ->latest()
    ->get();

echo "Total subscriptions: " . $subscriptions->count() . "\n";
echo "Total spent: $" . $subscriptions->sum('amount') . "\n";

foreach ($subscriptions as $sub) {
    echo "Subscription: " . ($sub->product->name ?? 'Unknown') . " - $" . $sub->amount;
    if ($sub->license) {
        echo " (License: " . $sub->license->license_key . ")";
    }
    echo "\n";
}
