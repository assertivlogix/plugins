<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Checking Products:\n";
echo "==================\n";

$products = App\Models\Product::all();
echo "Total Products: " . $products->count() . "\n\n";

foreach($products as $product) {
    echo "Product: " . $product->name . "\n";
    echo "Price Monthly: $" . $product->price_monthly . "\n";
    echo "Price Yearly: $" . $product->price_yearly . "\n";
    echo "-------------------\n";
}
