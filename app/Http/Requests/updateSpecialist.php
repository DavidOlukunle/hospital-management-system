<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateSpecialist extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required',
        'room_no' => 'required',
        'doctor_no' => 'required',
        'speciality' => 'required',
        
        ];
    }
}
