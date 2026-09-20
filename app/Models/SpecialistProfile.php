<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecialistProfile extends Model
{
    use HasFactory;

    public const APPROVAL_PENDING = 'PENDING';
    public const APPROVAL_APPROVED = 'APPROVED';
    public const APPROVAL_REJECTED = 'REJECTED';

    protected $fillable = [
        'user_id',
        'specialty_id',
        'doctor_number',
        'room_number',
        'bio',
        'profile_image',
        'approval_status',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

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
        return $this->hasMany(Appointment::class, 'specialist_id');
    }
}