<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
   use HasFactory;

   protected $fillable = ['name', 'slug', 'is_active'];

   public static function boot() {
       parent::boot();

       static::creating(function($category) {
           $category->slug = Str::slug($category->name);
       });

       static::updating(function($category) {
           $category->slug = Str::slug($category->name);
       });
   }

   public function posts() {
       return $this->belongsToMany(Post::class, 'category_post');
   }

   public function isActive() {
       return $this->is_active = 1;
   }
}
