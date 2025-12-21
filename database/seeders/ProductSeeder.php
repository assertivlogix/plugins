<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Moon Security Pro',
            'description' => 'A premium security plugin for WordPress.',
            'price_monthly' => 9.99,
            'price_yearly' => 99.99,
            'file_path' => 'plugins/moon-security-pro.zip',
            'stripe_price_id_monthly' => 'price_1234567890',
            'stripe_price_id_yearly' => 'price_0987654321',
        ]);

        Product::create([
            'name' => 'Moon SEO Pro',
            'description' => 'A premium SEO plugin for WordPress.',
            'price_monthly' => 7.99,
            'price_yearly' => 79.99,
            'file_path' => 'plugins/moon-seo-pro.zip',
            'stripe_price_id_monthly' => 'price_abcdefghij',
            'stripe_price_id_yearly' => 'price_jighfedcba',
        ]);
    }
}
