<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\License; // added this line to import the License model

class ActivatedSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_id',
        'domain',
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
