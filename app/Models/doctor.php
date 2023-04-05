<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable =['name','room_no','doctor_no','Image','speciality'];


    public function appointments() {
        return $this->hasMany(Appointments::class);
    }
}
