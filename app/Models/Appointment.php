<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable =['name', 'uuid', 'user_id',  'date',  'email', 'doctor', 'message', 'number', 'status'];


    public function specialist() {
        return $this->belongsTo(Specialist::class);
    }
}
