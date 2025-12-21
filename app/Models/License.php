<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'license_key',
        'activation_limit',
        'activations_used',
        'is_active',
        'status',
        'expires_at',
        'allowed_domains',
        'notes',
        'metadata',
        'version',
        'document_file',
        'certificate_file',
        'receipt_file',
        'file_metadata',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
        'allowed_domains' => 'array',
        'metadata' => 'array',
        'file_metadata' => 'array',
    ];

    public function subscription()
    {
        return $this->belongsTo(PluginSubscription::class);
    }

    public function activatedSites()
    {
        return $this->hasMany(ActivatedSite::class);
    }

    public static function generate()
    {
        return Str::upper(
            Str::random(4) . '-' .
            Str::random(4) . '-' .
            Str::random(4) . '-' .
            Str::random(4)
        );
    }
}
