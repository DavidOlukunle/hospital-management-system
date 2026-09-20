<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentStatusRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\SpecialistProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function store(StoreAppointmentRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $specialist = SpecialistProfile::whereHas(
            'user',
            function ($query) use ($validated) {
                $query->where(
                    'public_id',
                    $validated['specialist_public_id']
                );
            }
        )->firstOrFail();

        $appointment = DB::transaction(function () use (
            $validated,
            $request,
            $specialist
        ) {
            $specialist = SpecialistProfile::whereKey(
                $specialist->id
            )
                ->lockForUpdate()
                ->firstOrFail();

            if (
                $specialist->approval_status !==
                SpecialistProfile::APPROVAL_APPROVED
            ) {
                throw ValidationException::withMessages([
                    'specialist_public_id' => [
                        'This specialist is not currently available for appointments.',
                    ],
                ]);
            }

            $slotTaken = Appointment::where(
                'specialist_id',
                $specialist->id
            )
                ->where(
                    'appointment_date',
                    $validated['appointment_date']
                )
                ->where(
                    'appointment_time',
                    $validated['appointment_time']
                )
                ->whereIn('status', [
                    Appointment::STATUS_PENDING,
                    Appointment::STATUS_APPROVED,
                ])
                ->exists();

            if ($slotTaken) {
                throw ValidationException::withMessages([
                    'appointment_time' => [
                        'This specialist already has an appointment at this date and time.',
                    ],
                ]);
            }

            return Appointment::create([
                'patient_id' => $request->user()->id,
                'specialist_id' => $specialist->id,
                'appointment_date' => $validated['appointment_date'],
                'appointment_time' => $validated['appointment_time'],
                'reason' => $validated['reason'],
                'notes' => $validated['notes'] ?? null,
                'status' => Appointment::STATUS_PENDING,
            ]);
        });

        $appointment->load([
            'specialist.user',
            'specialist.specialty',
        ]);

        return response()->json([
            'message' => 'Appointment booked successfully.',
            'appointment' => new AppointmentResource($appointment),
        ], 201);
    }

    public function patientIndex(Request $request): JsonResponse
    {
        $appointments = Appointment::with([
            'specialist.user',
            'specialist.specialty',
        ])
            ->where('patient_id', $request->user()->id)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return response()->json([
            'appointments' => AppointmentResource::collection($appointments),
        ]);
    }

    public function specialistIndex(Request $request): JsonResponse
    {
        $specialist = $request->user()->specialistProfile;

        $appointments = Appointment::with([
            'patient',
            'specialist.user',
            'specialist.specialty',
        ])
            ->where('specialist_id', $specialist->id)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return response()->json([
            'appointments' => AppointmentResource::collection($appointments),
        ]);
    }

    public function updateStatus(
        UpdateAppointmentStatusRequest $request,
        string $publicId
    ): JsonResponse {
        $validated = $request->validated();

        $specialist = $request->user()->specialistProfile;

        $appointment = Appointment::where(
            'public_id',
            $publicId
        )
            ->where('specialist_id', $specialist->id)
            ->firstOrFail();

        $currentStatus = $appointment->status;
        $newStatus = $validated['status'];

        $allowedTransitions = [
            Appointment::STATUS_PENDING => [
                Appointment::STATUS_APPROVED,
                Appointment::STATUS_REJECTED,
            ],

            Appointment::STATUS_APPROVED => [
                Appointment::STATUS_COMPLETED,
                Appointment::STATUS_CANCELLED,
            ],

            Appointment::STATUS_REJECTED => [],

            Appointment::STATUS_COMPLETED => [],

            Appointment::STATUS_CANCELLED => [],
        ];

        if (
            !in_array(
                $newStatus,
                $allowedTransitions[$currentStatus] ?? [],
                true
            )
        ) {
            return response()->json([
                'message' => sprintf(
                    'Appointment cannot be changed from %s to %s.',
                    $currentStatus,
                    $newStatus
                ),
            ], 422);
        }

        $appointment->update([
            'status' => $newStatus,
        ]);

        return response()->json([
            'message' => 'Appointment status updated successfully.',
            'appointment' => [
                'public_id' => $appointment->public_id,
                'status' => $appointment->status,
            ],
        ]);
    }

    public function cancel(
        Request $request,
        string $publicId
    ): JsonResponse {
        $appointment = Appointment::where(
            'public_id',
            $publicId
        )
            ->where('patient_id', $request->user()->id)
            ->firstOrFail();

        if (
            !in_array(
                $appointment->status,
                [
                    Appointment::STATUS_PENDING,
                    Appointment::STATUS_APPROVED,
                ],
                true
            )
        ) {
            return response()->json([
                'message' => sprintf(
                    'Appointment cannot be cancelled while its status is %s.',
                    $appointment->status
                ),
            ], 422);
        }

        $appointment->update([
            'status' => Appointment::STATUS_CANCELLED,
        ]);

        return response()->json([
            'message' => 'Appointment cancelled successfully.',
            'appointment' => [
                'public_id' => $appointment->public_id,
                'status' => $appointment->status,
            ],
        ]);
    }
}

