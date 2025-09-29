<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Mass assignable fields
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role', // must be fillable
    ];

    // Hidden fields for serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // automatically hashes password on save
    ];
}
