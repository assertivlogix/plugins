<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'forum_category_id', 'title', 'slug', 'is_pinned', 'is_locked', 'views_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'forum_category_id');
    }

    public function posts()
    {
        return $this->hasMany(ForumPost::class);
    }
}
