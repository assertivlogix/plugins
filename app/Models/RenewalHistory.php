<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewalHistory extends Model
{
    use HasFactory;

    protected $table = 'renewal_history';

    protected $fillable = [
        'user_id',
        'license_id',
        'subscription_id',
        'product_id',
        'plan',
        'amount',
        'currency',
        'renewal_type',
        'transaction_id',
        'payment_method',
        'payment_intent_id',
        'customer_id',
        'renewal_start_date',
        'renewal_end_date',
        'notes',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'renewal_start_date' => 'datetime',
        'renewal_end_date' => 'datetime',
        'metadata' => 'array',
    ];

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

    /**
     * Create a renewal history record
     */
    public static function createRenewalRecord($license, $subscription, $renewalData)
    {
        return self::create([
            'user_id' => $subscription->user_id,
            'license_id' => $license->id,
            'subscription_id' => $subscription->id,
            'product_id' => $subscription->product_id,
            'plan' => $renewalData['plan'],
            'amount' => $renewalData['amount'],
            'currency' => $subscription->currency ?? 'USD',
            'renewal_type' => $renewalData['renewal_type'] ?? 'extension',
            'transaction_id' => $renewalData['transaction_id'] ?? null,
            'payment_method' => $renewalData['payment_method'] ?? null,
            'payment_intent_id' => $renewalData['payment_intent_id'] ?? null,
            'customer_id' => $renewalData['customer_id'] ?? null,
            'renewal_start_date' => $renewalData['start_date'] ?? null,
            'renewal_end_date' => $renewalData['end_date'] ?? null,
            'notes' => $renewalData['notes'] ?? null,
            'metadata' => $renewalData['metadata'] ?? null,
        ]);
    }
}
