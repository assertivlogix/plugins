<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\License;

class PluginSubscription extends Model
{
    use HasFactory;

    protected $table = 'plugin_subscriptions';

    protected $fillable = [
        'user_id',
        'product_id',
        'plan',
        'amount',
        'currency',
        'status',
        'starts_at',
        'expires_at',
        'stripe_subscription_id',
        'stripe_payment_intent_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function license()
    {
        return $this->hasOne(License::class, 'subscription_id');
    }

    public function licenses()
    {
        return $this->hasMany(License::class, 'subscription_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'subscription_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeMonthly($query)
    {
        return $query->where('plan', 'monthly');
    }

    public function scopeYearly($query)
    {
        return $query->where('plan', 'yearly');
    }

    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }

    public function isActive()
    {
        return $this->status === 'active' && 
               (!$this->expires_at || $this->expires_at->isFuture());
    }
}
