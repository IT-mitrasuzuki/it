<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class useratt extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table ="useratt";
    protected $primarykey ="id";

    protected $fillable = [
        'username',
        'password',
        'id_level', 
        'dibuat', 
        'tgl_buat',
        'diupdate',
        'tgl_update',
        'nama',
        'jabatan',
        'cabang',
        'email',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
