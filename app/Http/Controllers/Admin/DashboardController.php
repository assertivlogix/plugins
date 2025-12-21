<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\License;
use App\Models\PluginSubscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Sync any subscriptions that don't have transactions
        $this->syncSubscriptionTransactions();
        
        $data = [
            'totalUsers' => User::count(),
            'totalProducts' => Product::count(),
            'totalLicenses' => License::count(),
            'totalRevenue' => Transaction::where('status', 'completed')->sum('amount'),
            'activeSubscriptions' => PluginSubscription::where('status', 'active')->count(),
            'recentUsers' => User::latest()->take(5)->get(),
            'recentProducts' => Product::latest()->take(5)->get(),
            'recentPurchases' => Transaction::with(['user', 'product'])
                ->where('status', 'completed')
                ->latest()
                ->take(5)
                ->get(),
            'monthlyUsers' => $this->getMonthlyUsers(),
            'monthlyRevenue' => $this->getMonthlyRevenue(),
            // Additional revenue metrics
            'todayRevenue' => Transaction::where('status', 'completed')
                                ->whereDate('created_at', today())
                                ->sum('amount'),
            'thisMonthRevenue' => Transaction::where('status', 'completed')
                                   ->whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->sum('amount'),
            'totalTransactions' => Transaction::count(),
            'completedTransactions' => Transaction::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Sync existing subscriptions with transaction records
     */
    private function syncSubscriptionTransactions()
    {
        $subscriptionsWithoutTransactions = PluginSubscription::whereDoesntHave('transactions')->get();
        
        foreach ($subscriptionsWithoutTransactions as $subscription) {
            // Get the license once to avoid duplicate queries
            $license = License::where('subscription_id', $subscription->id)->first();
            
            // Create a transaction record for existing subscriptions
            Transaction::create([
                'user_id' => $subscription->user_id,
                'license_id' => $license ? $license->id : null,
                'subscription_id' => $subscription->id,
                'product_id' => $subscription->product_id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'purchase',
                'status' => 'completed',
                'amount' => $subscription->amount,
                'currency' => 'USD',
                'payment_method' => 'system',
                'product_name' => $subscription->product->name,
                'plan' => $subscription->plan,
                'license_key' => $license ? $license->license_key : null,
                'period_start' => $subscription->starts_at,
                'period_end' => $subscription->expires_at,
                'auto_renewal' => false,
                'billing_name' => $subscription->user->name,
                'billing_email' => $subscription->user->email,
                'description' => "Purchase of {$subscription->product->name} - {$subscription->plan} plan",
                'processed_at' => $subscription->created_at,
                'created_at' => $subscription->created_at,
                'updated_at' => $subscription->updated_at,
            ]);
        }
    }

    private function getMonthlyUsers()
    {
        $months = collect();
        $now = Carbon::now();

        for ($i = 6; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $count = User::whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month)
                        ->count();
            
            $months->push([
                'month' => $month->format('M Y'),
                'users' => $count
            ]);
        }

        return $months;
    }

    private function getMonthlyRevenue()
    {
        $months = collect();
        $now = Carbon::now();

        for ($i = 6; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $revenue = Transaction::where('status', 'completed')
                        ->whereYear('created_at', $month->year)
                        ->whereMonth('created_at', $month->month)
                        ->sum('amount');
            
            $months->push([
                'month' => $month->format('M Y'),
                'revenue' => $revenue
            ]);
        }

        return $months;
    }
}
