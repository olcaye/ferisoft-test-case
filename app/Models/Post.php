<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'status', 'registered_only', 'slug'];

    public static function boot() {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class,'category_post');
    }

    public function isActive() {
        return $this->status;
    }

    public function isRegisteredOnly() {
        return $this->registered_only;
    }
}
