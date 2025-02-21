<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class,'role_user');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function hasRole(string $role) {
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasAnyRoles(array $roles) {
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    public function hasAnyRole(string $role) {
        return $this->roles()->where('name', $role)->exists();
    }

    public function isAdmin() {
        return $this->hasRole('admin');
    }

    public function isEditor() {
        return $this->hasRole('editor');
    }

    public function isAdminOrEditor() {
        return $this->isAdmin() || $this->isEditor();
    }
}
