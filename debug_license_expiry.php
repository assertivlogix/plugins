<?php

require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\License;

$licenseKey = '8A44A3CE4BE5D9A5-686839BA02EE26DA';
$license = License::with('subscription')->where('license_key', $licenseKey)->first();

if ($license) {
    echo "License ID: " . $license->id . "\n";
    echo "License expires_at: " . ($license->expires_at ? $license->expires_at->toDateTimeString() : 'NULL') . "\n";
    
    if ($license->subscription) {
        echo "Subscription ID: " . $license->subscription->id . "\n";
        echo "Subscription expires_at: " . ($license->subscription->expires_at ? $license->subscription->expires_at->toDateTimeString() : 'NULL') . "\n";
    } else {
        echo "No subscription linked.\n";
    }
} else {
    echo "License not found.\n";
}
