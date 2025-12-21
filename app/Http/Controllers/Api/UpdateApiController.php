<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateApiController extends Controller
{
    /**
     * Handle plugin update check.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {
        // Support both POST and GET parameters
        $slug = $request->input('slug');
        $currentVersion = $request->input('version');
        
        // Validation
        if (!$slug) {
            return response()->json(['error' => 'Missing slug parameter'], 400);
        }

        // Handle cases where slug might be passed as 'folder/file.php'
        if (str_contains($slug, '/')) {
            $parts = explode('/', $slug);
            $slug = $parts[0];
        }

        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return response()->json(['error' => 'Plugin not found'], 404);
        }

        $newVersion = $product->version;
        
        // Basic response structure
        $response = [
            'slug' => $slug,
            'name' => $product->name,
            'new_version' => $newVersion,
            'tested' => $product->tested_up_to,
            'requires' => $product->requires_wordpress,
            'requires_php' => $product->requires_php,
            'last_updated' => $product->updated_at->format('Y-m-d H:i:s'),
            'homepage' => url('/plugin/' . $product->slug),
        ];

        // If update is available
        if ($currentVersion && version_compare($currentVersion, $newVersion, '<')) {
            $response['package'] = $product->file_path && !str_starts_with($product->file_path, 'http') 
                ? asset('storage/' . $product->file_path) 
                : $product->file_path;
                
            // Include sections for the "View Details" modal in WordPress
            $response['sections'] = [
                'description' => $product->description,
                'changelog' => $product->changelog ?? 'No changelog available.',
            ];
        }

        return response()->json($response);
    }
}
