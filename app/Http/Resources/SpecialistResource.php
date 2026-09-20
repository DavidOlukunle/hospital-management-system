<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialistResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'public_id' => $this->user->public_id,
            'name' => $this->user->name,
            'doctor_number' => $this->doctor_number,
            'room_number' => $this->room_number,
            'bio' => $this->bio,
            'profile_image' => $this->profile_image,

            'approval_status' => $this->when(
                $this->approval_status !== null,
                $this->approval_status
            ),

            'approved_at' => $this->when(
                $this->approved_at !== null,
                $this->approved_at
            ),

            'specialty' => [
                'id' => $this->specialty->id,
                'name' => $this->specialty->name,
                'description' => $this->specialty->description,
            ],
        ];
    }
}