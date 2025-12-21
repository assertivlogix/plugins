<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'version',
        'tested_up_to',
        'requires_php',
        'requires_wordpress',
        'price_monthly',
        'price_yearly',
        'file_path',
        'banner_image',
        'icon_image',
        'is_active',
        'changelog',
        'documentation_url',
        'github_url',
        'support_url',
        'default_activation_limit',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_monthly' => 'float',
        'price_yearly' => 'float',
        'default_activation_limit' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subscriptions()
    {
        return $this->hasMany(PluginSubscription::class);
    }

    /**
     * Get the product name with rebranding.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return str_replace('Moon', 'Assertivlogix', $value);
    }

    /**
     * Get the product description with rebranding.
     *
     * @param  string  $value
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        return str_replace('Moon', 'Assertivlogix', $value);
    }

    /**
     * Get the product short description with rebranding.
     *
     * @param  string  $value
     * @return string
     */
    public function getShortDescriptionAttribute($value)
    {
        return str_replace('Moon', 'Assertivlogix', $value);
    }
    /**
     * Get the product category from slug.
     *
     * @return string
     */
    public function getCategoryAttribute()
    {
        if (str_contains($this->slug, 'security')) return 'security';
        if (str_contains($this->slug, 'seo')) return 'seo';
        if (str_contains($this->slug, 'backup')) return 'backup';
        if (str_contains($this->slug, 'performance')) return 'performance';
        if (str_contains($this->slug, 'analytics')) return 'analytics';
        if (str_contains($this->slug, 'central') || str_contains($this->slug, 'management')) return 'management';
        return 'other';
    }
}
