<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_PATIENT = 'PATIENT';

    public const ROLE_SPECIALIST = 'SPECIALIST';

    public const ROLE_ADMIN = 'ADMIN';

    public const STATUS_ACTIVE = 'ACTIVE';

    public const STATUS_SUSPENDED = 'SUSPENDED';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'status',
    'profile_image',
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
    ];

    protected static function booted(): void
{
    static::creating(function (User $user) {
        if (empty($user->public_id)) {
            $user->public_id = (string) Str::uuid();
        }
    });
}

public function specialistProfile(): HasOne
{
    return $this->hasOne(SpecialistProfile::class);
}

public function appointments(): HasMany
{
    return $this->hasMany(Appointment::class, 'patient_id');
}

public function isPatient(): bool
{
    return $this->role === self::ROLE_PATIENT;
}

public function isSpecialist(): bool
{
    return $this->role === self::ROLE_SPECIALIST;
}

public function isAdmin(): bool
{
    return $this->role === self::ROLE_ADMIN;
}

public function isActive(): bool
{
    return $this->status === self::STATUS_ACTIVE;
}
}
