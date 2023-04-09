<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'room_no', 'doctor_no', 'speciality', 'image'];

    public function appointment() {
        return $this->hasMany(Appointment::class);
    }
}
