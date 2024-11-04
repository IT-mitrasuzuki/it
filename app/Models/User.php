<?php

namespace App\Models;

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
     * @var array
     */
    protected $fillable = [
        'nama',  // Name of the user
        'email',  // Email address of the user
        'username',  // Username of the user
        'level',  // Level or role of the user
        'password',  // Encrypted password of the user
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',  // Hide the password
        'remember_token',  // Hide the remember token
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',  // Cast email_verified_at to datetime
        'password' => 'hashed',  // Cast password to hashed (automatically hashed)
    ];
}
