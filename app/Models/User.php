<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'avatar',
        'bio',
        'role', // admin, author, user
        'status', // active, inactive

    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * The attributes that should be appended to the model's array form.
     *
     * @var list<string>
     */
    protected $appends = [
        'is_admin',
        'is_author',
        'is_user',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    public function getIsAdminAttribute(): bool
    {
        return $this->role === 'admin';
    }

    public function getIsAuthorAttribute(): bool
    {
        return $this->role === 'author';
    }

    public function getIsUserAttribute(): bool
    {
        return $this->role === 'user';
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
