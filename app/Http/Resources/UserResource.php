<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'public_id' => $this->public_id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
            'profile_image' => $this->profile_image,

            'specialist' => $this->when(
                $this->relationLoaded('specialistProfile') &&
                $this->specialistProfile !== null,
                function () {
                    return [
                        'doctor_number' =>
                            $this->specialistProfile->doctor_number,

                        'room_number' =>
                            $this->specialistProfile->room_number,

                        'approval_status' =>
                            $this->specialistProfile->approval_status,

                        'approved_at' =>
                            $this->specialistProfile->approved_at,

                        'specialty' => [
                            'id' =>
                                $this->specialistProfile->specialty->id,

                            'name' =>
                                $this->specialistProfile->specialty->name,
                        ],
                    ];
                }
            ),
        ];
    }
}