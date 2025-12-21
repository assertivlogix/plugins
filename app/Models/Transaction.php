<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'license_id',
        'subscription_id',
        'product_id',
        'transaction_id',
        'type',
        'status',
        'amount',
        'currency',
        'payment_method',
        'payment_gateway_transaction_id',
        'payment_gateway_customer_id',
        'payment_metadata',
        'product_name',
        'plan',
        'original_amount',
        'discount_amount',
        'discount_code',
        'license_key',
        'period_start',
        'period_end',
        'auto_renewal',
        'billing_name',
        'billing_email',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_country',
        'billing_postal_code',
        'billing_phone',
        'description',
        'metadata',
        'notes',
        'processed_at',
        'refunded_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'original_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'payment_metadata' => 'array',
        'metadata' => 'array',
        'period_start' => 'datetime',
        'period_end' => 'datetime',
        'processed_at' => 'datetime',
        'refunded_at' => 'datetime',
        'auto_renewal' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }

    public function subscription()
    {
        return $this->belongsTo(PluginSubscription::class, 'subscription_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    public function scopePurchases($query)
    {
        return $query->where('type', 'purchase');
    }

    public function scopeRenewals($query)
    {
        return $query->where('type', 'renewal');
    }

    public function scopeRefunds($query)
    {
        return $query->where('type', 'refund');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeInPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Helper Methods
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }

    public function isRefunded()
    {
        return $this->status === 'refunded';
    }

    public function isPurchase()
    {
        return $this->type === 'purchase';
    }

    public function isRenewal()
    {
        return $this->type === 'renewal';
    }

    public function getFormattedAmount()
    {
        return number_format($this->amount, 2);
    }

    public function getFormattedCurrency()
    {
        return strtoupper($this->currency);
    }

    public function getDisplayAmount()
    {
        return $this->getFormattedCurrency() . ' ' . $this->getFormattedAmount();
    }

    public function getBillingFullName()
    {
        return $this->billing_name;
    }

    public function getPeriodDuration()
    {
        if (!$this->period_start || !$this->period_end) {
            return null;
        }

        $start = $this->period_start;
        $end = $this->period_end;
        
        if ($this->plan === 'monthly') {
            $days = $start->diffInDays($end);
            return $days . ' days';
        } elseif ($this->plan === 'yearly') {
            $months = $start->diffInMonths($end);
            return $months . ' months';
        }
        
        return $start->diffInDays($end) . ' days';
    }

    // Static Methods for Creating Transactions
    public static function createPurchase($subscription, $paymentData = [])
    {
        $user = $subscription->user;
        $product = $subscription->product;
        
        return self::create([
            'user_id' => $user->id,
            'license_id' => $subscription->license->id ?? null,
            'subscription_id' => $subscription->id,
            'product_id' => $product->id,
            'transaction_id' => self::generateTransactionId(),
            'type' => 'purchase',
            'status' => 'completed',
            'amount' => $subscription->amount,
            'currency' => $subscription->currency ?? 'USD',
            'payment_method' => $paymentData['payment_method'] ?? 'stripe',
            'payment_gateway_transaction_id' => $paymentData['payment_intent_id'] ?? null,
            'payment_gateway_customer_id' => $paymentData['customer_id'] ?? null,
            'payment_metadata' => $paymentData['payment_metadata'] ?? null,
            'product_name' => $product->name,
            'plan' => $subscription->plan,
            'original_amount' => $paymentData['original_amount'] ?? $subscription->amount,
            'discount_amount' => $paymentData['discount_amount'] ?? 0,
            'discount_code' => $paymentData['discount_code'] ?? null,
            'license_key' => $subscription->license->license_key ?? null,
            'period_start' => $subscription->starts_at,
            'period_end' => $subscription->expires_at,
            'auto_renewal' => false,
            'billing_name' => $user->name,
            'billing_email' => $user->email,
            'description' => "Purchase of {$product->name} - {$subscription->plan} plan",
            'metadata' => $paymentData['metadata'] ?? null,
            'processed_at' => now(),
        ]);
    }

    public static function createRenewal($renewalData, $paymentData = [])
    {
        return self::create([
            'user_id' => $renewalData['user_id'],
            'license_id' => $renewalData['license_id'],
            'subscription_id' => $renewalData['subscription_id'],
            'product_id' => $renewalData['product_id'],
            'transaction_id' => self::generateTransactionId(),
            'type' => 'renewal',
            'status' => 'completed',
            'amount' => $renewalData['amount'],
            'currency' => $renewalData['currency'] ?? 'USD',
            'payment_method' => $paymentData['payment_method'] ?? 'stripe',
            'payment_gateway_transaction_id' => $paymentData['payment_intent_id'] ?? null,
            'payment_gateway_customer_id' => $paymentData['customer_id'] ?? null,
            'payment_metadata' => $paymentData['payment_metadata'] ?? null,
            'product_name' => $renewalData['product_name'],
            'plan' => $renewalData['plan'],
            'original_amount' => $renewalData['original_amount'] ?? $renewalData['amount'],
            'discount_amount' => $renewalData['discount_amount'] ?? 0,
            'discount_code' => $renewalData['discount_code'] ?? null,
            'license_key' => $renewalData['license_key'],
            'period_start' => $renewalData['start_date'],
            'period_end' => $renewalData['end_date'],
            'auto_renewal' => $renewalData['auto_renewal'] ?? false,
            'billing_name' => $renewalData['billing_name'],
            'billing_email' => $renewalData['billing_email'],
            'description' => "Renewal of {$renewalData['product_name']} - {$renewalData['plan']} plan",
            'metadata' => $renewalData['metadata'] ?? null,
            'processed_at' => now(),
        ]);
    }

    public static function generateTransactionId()
    {
        return 'TXN-' . date('Y') . '-' . strtoupper(uniqid());
    }

    // Refund Methods
    public function refund($amount = null, $reason = null)
    {
        $refundAmount = $amount ?? $this->amount;
        
        $this->update([
            'status' => 'refunded',
            'refunded_at' => now(),
            'notes' => $reason ? "Refunded: {$reason}" : "Refunded",
        ]);

        // Create refund transaction
        return self::create([
            'user_id' => $this->user_id,
            'license_id' => $this->license_id,
            'subscription_id' => $this->subscription_id,
            'product_id' => $this->product_id,
            'transaction_id' => self::generateTransactionId(),
            'type' => 'refund',
            'status' => 'completed',
            'amount' => -$refundAmount, // Negative amount for refunds
            'currency' => $this->currency,
            'payment_method' => $this->payment_method,
            'payment_gateway_transaction_id' => $this->payment_gateway_transaction_id,
            'product_name' => $this->product_name,
            'plan' => $this->plan,
            'license_key' => $this->license_key,
            'billing_name' => $this->billing_name,
            'billing_email' => $this->billing_email,
            'description' => "Refund for {$this->product_name} - {$this->plan} plan",
            'metadata' => [
                'original_transaction_id' => $this->transaction_id,
                'refund_reason' => $reason,
            ],
            'processed_at' => now(),
        ]);
    }
}
