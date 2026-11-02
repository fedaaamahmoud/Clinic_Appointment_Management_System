<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Patient appointments
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    // Doctor profile
    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class);
    }

    // Patient reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}
