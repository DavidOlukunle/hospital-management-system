<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    public function index(): JsonResponse
    {
        $appointments = Appointment::with([
            'patient',
            'specialist.user',
            'specialist.specialty',
        ])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return response()->json([
            'appointments' => $appointments->map(function ($appointment) {
                return [
                    'public_id' => $appointment->public_id,
                    'appointment_date' => $appointment->appointment_date,
                    'appointment_time' => $appointment->appointment_time,
                    'reason' => $appointment->reason,
                    'notes' => $appointment->notes,
                    'status' => $appointment->status,

                    'patient' => [
                        'public_id' => $appointment->patient->public_id,
                        'name' => $appointment->patient->name,
                        'email' => $appointment->patient->email,
                    ],

                    'specialist' => [
                        'public_id' => $appointment->specialist->user->public_id,
                        'name' => $appointment->specialist->user->name,
                        'doctor_number' => $appointment->specialist->doctor_number,
                        'room_number' => $appointment->specialist->room_number,
                        'specialty' => [
                            'id' => $appointment->specialist->specialty->id,
                            'name' => $appointment->specialist->specialty->name,
                        ],
                    ],
                ];
            }),
        ]);
    }
}