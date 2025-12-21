<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\PluginSubscription;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index(Request $request)
    {
        $licenses = License::with(['subscription.user', 'subscription.product'])
            ->when($request->search, function($query, $search) {
                $query->where('license_key', 'like', "%{$search}%")
                      ->orWhereHas('subscription.user', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                      })
                      ->orWhereHas('subscription.product', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
            })
            ->when($request->status, function($query, $status) {
                if ($status === 'active') {
                    $query->whereHas('subscription', function($q) {
                        $q->where('status', 'active')
                          ->where(function($subQ) {
                              $subQ->whereNull('expires_at')
                                   ->orWhere('expires_at', '>', now());
                          });
                    });
                } elseif ($status === 'expired') {
                    $query->whereHas('subscription', function($q) {
                        $q->where('expires_at', '<', now());
                    });
                } elseif ($status === 'cancelled') {
                    $query->whereHas('subscription', function($q) {
                        $q->where('status', 'cancelled');
                    });
                }
            })
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => License::count(),
            'active' => License::whereHas('subscription', function($q) {
                $q->where('status', 'active')
                  ->where(function($subQ) {
                      $subQ->whereNull('expires_at')
                           ->orWhere('expires_at', '>', now());
                  });
            })->count(),
            'expired' => License::whereHas('subscription', function($q) {
                $q->where('expires_at', '<', now());
            })->count(),
            'cancelled' => License::whereHas('subscription', function($q) {
                $q->where('status', 'cancelled');
            })->count(),
        ];

        return view('admin.licenses.index', compact('licenses', 'stats'));
    }

    public function show(License $license)
    {
        $license->load(['subscription.user', 'subscription.product', 'activatedSites']);
        
        // Get all transactions related to this license
        $transactions = Transaction::where('license_id', $license->id)
            ->with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Get initial purchase transaction
        $initialPurchase = $transactions->where('type', 'purchase')->first();
        
        // Get renewal transactions
        $renewals = $transactions->where('type', 'renewal');
        
        // Calculate total spent on this license
        $totalSpent = $transactions->where('status', 'completed')->sum('amount');
        
        // Get subscription details
        $subscription = $license->subscription;
        
        return view('admin.licenses.show', compact('license', 'transactions', 'initialPurchase', 'renewals', 'totalSpent', 'subscription'));
    }

    public function update(Request $request, License $license)
    {
        $validated = $request->validate([
            'activation_limit' => 'required|integer|min:1|max:100',
        ]);

        try {
            $license->update($validated);
            return redirect()->route('admin.licenses.show', $license)
                ->with('success', 'License activation limit updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.licenses.show', $license)
                ->with('error', 'Failed to update license: ' . $e->getMessage());
        }
    }

    public function destroy(License $license)
    {
        try {
            $license->delete();
            return redirect()->route('admin.licenses.index')
                ->with('success', 'License deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.licenses.index')
                ->with('error', 'Failed to delete license: ' . $e->getMessage());
        }
    }
}
