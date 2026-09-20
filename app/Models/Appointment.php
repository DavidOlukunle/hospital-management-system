<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'PENDING';
    public const STATUS_APPROVED = 'APPROVED';
    public const STATUS_REJECTED = 'REJECTED';
    public const STATUS_COMPLETED = 'COMPLETED';
    public const STATUS_CANCELLED = 'CANCELLED';

    protected $table = 'appointments_v2';

    protected $fillable = [
        'public_id',
        'patient_id',
        'specialist_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'notes',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    protected static function booted(): void
{
    static::creating(function (Appointment $appointment) {
        if (empty($appointment->public_id)) {
            $appointment->public_id = (string) Str::uuid();
        }
    });
}

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(
            SpecialistProfile::class,
            'specialist_id'
        );
    }
}
