<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PricingController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();
        return view('pricing.index', compact('products'));
    }
}
