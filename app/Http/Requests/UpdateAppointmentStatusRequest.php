<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isSpecialist() === true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                'string',
                'in:APPROVED,REJECTED,COMPLETED,CANCELLED',
            ],
        ];
    }
}