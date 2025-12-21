<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\ActivatedSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LicenseApiController extends Controller
{
    public function validateLicense(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'license_key' => 'required|string',
            'site_url' => 'required|url',
            'product_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request data',
                'errors' => $validator->errors()
            ], 400);
        }

        $licenseKey = $request->input('license_key');
        $siteUrl = $request->input('site_url');
        $productId = $request->input('product_id');
        $domain = parse_url($siteUrl, PHP_URL_HOST);

        if (!$domain) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid site URL'
            ], 400);
        }

        $license = License::with('subscription')->where('license_key', $licenseKey)->first();

        if (!$license) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid license key'
            ], 404);
        }

        // Check if license belongs to the correct product
        if (!$license->subscription || $license->subscription->product_id != $productId) {
            return response()->json([
                'success' => false,
                'message' => 'License key does not belong to this product'
            ], 403);
        }

        // Check if license is active
        if (!$license->is_active || ($license->status !== 'active' && $license->status !== 'expired')) {
            return response()->json([
                'success' => false,
                'message' => 'License is inactive or suspended'
            ], 403);
        }

        // Determine expiration date
        $expiresAt = $license->expires_at;
        if (!$expiresAt && $license->subscription) {
            $expiresAt = $license->subscription->expires_at;
        }

        // Check expiration
        if ($expiresAt && Carbon::now()->gt($expiresAt)) {
            return response()->json([
                'success' => false,
                'message' => 'License has expired',
                'expires_at' => $expiresAt->toDateTimeString()
            ], 403);
        }

        // Check if site is already activated
        $existingActivation = $license->activatedSites()->where('domain', $domain)->first();

        if ($existingActivation) {
            return response()->json([
                'success' => true,
                'message' => 'License is valid and active',
                'data' => [
                    'license_key' => $license->license_key,
                    'status' => 'active',
                    'expires_at' => $expiresAt ? $expiresAt->toDateTimeString() : 'lifetime',
                    'activations_used' => $license->activations_used,
                    'activation_limit' => $license->activation_limit,
                ]
            ]);
        }

        // Check activation limit
        if ($license->activations_used >= $license->activation_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Activation limit reached',
                'activations_used' => $license->activations_used,
                'activation_limit' => $license->activation_limit
            ], 403);
        }

        // Activate site
        try {
            $license->activatedSites()->create([
                'domain' => $domain
            ]);

            $license->increment('activations_used');

            return response()->json([
                'success' => true,
                'message' => 'License activated successfully',
                'data' => [
                    'license_key' => $license->license_key,
                    'status' => 'active',
                    'expires_at' => $expiresAt ? $expiresAt->toDateTimeString() : 'lifetime',
                    'activations_used' => $license->activations_used,
                    'activation_limit' => $license->activation_limit,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to activate license: ' . $e->getMessage()
            ], 500);
        }
    }
}
