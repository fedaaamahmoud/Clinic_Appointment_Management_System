<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    // Appointment review
    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
