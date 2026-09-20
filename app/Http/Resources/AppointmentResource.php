<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'public_id' => $this->public_id,
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'status' => $this->status,

            'patient' => $this->whenLoaded('patient', function () {
                return [
                    'public_id' => $this->patient->public_id,
                    'name' => $this->patient->name,
                    'email' => $this->patient->email,
                ];
            }),

            'specialist' => $this->whenLoaded('specialist', function () {
                return [
                    'public_id' => $this->specialist->user->public_id,
                    'name' => $this->specialist->user->name,
                    'doctor_number' => $this->specialist->doctor_number,
                    'room_number' => $this->specialist->room_number,

                    'specialty' => [
                        'id' => $this->specialist->specialty->id,
                        'name' => $this->specialist->specialty->name,
                    ],
                ];
            }),
        ];
    }
}