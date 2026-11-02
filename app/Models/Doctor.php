<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'specialty_id',
        'phone',
        'email',
        'bio',
        'is_available',
        'working_days',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
            'working_days' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    // Doctor reviews
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}