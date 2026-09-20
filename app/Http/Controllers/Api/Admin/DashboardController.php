<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\SpecialistProfile;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'users' => [
                'total' => User::count(),

                'patients' => User::where(
                    'role',
                    User::ROLE_PATIENT
                )->count(),

                'specialists' => User::where(
                    'role',
                    User::ROLE_SPECIALIST
                )->count(),

                'admins' => User::where(
                    'role',
                    User::ROLE_ADMIN
                )->count(),
            ],

            'specialist_applications' => [
                'pending' => SpecialistProfile::where(
                    'approval_status',
                    SpecialistProfile::APPROVAL_PENDING
                )->count(),

                'approved' => SpecialistProfile::where(
                    'approval_status',
                    SpecialistProfile::APPROVAL_APPROVED
                )->count(),

                'rejected' => SpecialistProfile::where(
                    'approval_status',
                    SpecialistProfile::APPROVAL_REJECTED
                )->count(),
            ],

            'appointments' => [
                'total' => Appointment::count(),

                'pending' => Appointment::where(
                    'status',
                    Appointment::STATUS_PENDING
                )->count(),

                'approved' => Appointment::where(
                    'status',
                    Appointment::STATUS_APPROVED
                )->count(),

                'rejected' => Appointment::where(
                    'status',
                    Appointment::STATUS_REJECTED
                )->count(),

                'completed' => Appointment::where(
                    'status',
                    Appointment::STATUS_COMPLETED
                )->count(),

                'cancelled' => Appointment::where(
                    'status',
                    Appointment::STATUS_CANCELLED
                )->count(),
            ],
        ]);
    }
}