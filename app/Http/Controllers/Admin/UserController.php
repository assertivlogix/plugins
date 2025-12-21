<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully');
    }

    public function show(User $user)
    {
        // Load user with all related data
        $user->load([
            'subscriptions.product',
            'subscriptions.license.activatedSites'
        ]);

        // Get user statistics
        $stats = [
            'total_subscriptions' => $user->subscriptions()->count(),
            'active_subscriptions' => $user->subscriptions()->where('status', 'active')->count(),
            'total_spent' => Transaction::where('user_id', $user->id)->where('status', 'completed')->sum('amount'),
            'total_licenses' => $user->subscriptions()->with('license')->get()->pluck('license')->filter()->count(),
            'total_activated_sites' => $user->subscriptions()->with('license.activatedSites')->get()->pluck('license.activatedSites')->flatten()->count(),
            'total_transactions' => Transaction::where('user_id', $user->id)->count(),
            'completed_transactions' => Transaction::where('user_id', $user->id)->where('status', 'completed')->count(),
        ];

        // Get comprehensive recent activity including transactions
        $recentActivity = $this->getUserRecentActivity($user);

        // Get activated sites
        $activatedSites = $user->subscriptions()
            ->with(['license.activatedSites', 'product'])
            ->whereHas('license.activatedSites')
            ->get()
            ->map(function ($subscription) {
                return [
                    'product_name' => $subscription->product->name,
                    'sites' => $subscription->license->activatedSites->pluck('domain')
                ];
            });

        return view('admin.users.show', compact('user', 'stats', 'recentActivity', 'activatedSites'));
    }

    /**
     * Get comprehensive recent activity including subscriptions and transactions
     */
    private function getUserRecentActivity(User $user)
    {
        $activities = collect();

        // Get recent transactions
        $transactions = Transaction::where('user_id', $user->id)
            ->with(['product'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($transaction) {
                return [
                    'type' => 'transaction',
                    'id' => $transaction->id,
                    'product' => $transaction->product,
                    'product_name' => $transaction->product_name,
                    'plan' => $transaction->plan,
                    'amount' => $transaction->amount,
                    'status' => $transaction->status,
                    'transaction_type' => $transaction->type,
                    'created_at' => $transaction->created_at,
                    'processed_at' => $transaction->processed_at,
                    'license_key' => $transaction->license_key,
                    'description' => $transaction->description,
                ];
            });

        // Get recent subscriptions
        $subscriptions = $user->subscriptions()
            ->with(['product', 'license'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($subscription) {
                return [
                    'type' => 'subscription',
                    'id' => $subscription->id,
                    'product' => $subscription->product,
                    'product_name' => $subscription->product->name,
                    'plan' => $subscription->plan,
                    'amount' => $subscription->amount,
                    'status' => $subscription->status,
                    'starts_at' => $subscription->starts_at,
                    'expires_at' => $subscription->expires_at,
                    'created_at' => $subscription->created_at,
                    'license' => $subscription->license,
                ];
            });

        // Merge and sort by date
        return $activities->merge($transactions)
            ->merge($subscriptions)
            ->sortByDesc('created_at')
            ->take(20)
            ->values();
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if ($request->filled('password')) {
            $user->password = bcrypt($validated['password']);
        }
        
        $user->is_admin = $request->has('is_admin');
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot delete your own account');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
