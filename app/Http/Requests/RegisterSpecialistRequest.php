<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterSpecialistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'specialty_id' => [
                'required',
                'integer',
                'exists:specialties,id',
            ],

            'doctor_number' => [
                'required',
                'string',
                'max:255',
                'unique:specialist_profiles,doctor_number',
            ],

            'room_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'bio' => [
                'nullable',
                'string',
            ],
        ];
    }

    protected function failedValidation(Validator $validator): void
{
    throw new HttpResponseException(
        response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422)
    );
}
}