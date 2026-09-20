<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpecialistProfile;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\SpecialistResource;
use App\Http\Requests\RegisterSpecialistRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SpecialistController extends Controller
{
    public function register(RegisterSpecialistRequest $request): JsonResponse
    {
        $validated = $request->validated();
            
        

        $specialist = DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => User::ROLE_SPECIALIST,
                'status' => User::STATUS_ACTIVE,
            ]);

            SpecialistProfile::create([
                'user_id' => $user->id,
                'specialty_id' => $validated['specialty_id'],
                'doctor_number' => $validated['doctor_number'],
                'room_number' => $validated['room_number'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'approval_status' => SpecialistProfile::APPROVAL_PENDING,
            ]);

            return $user->load('specialistProfile.specialty');
        });

        return response()->json([
            'message' => 'Specialist registration submitted successfully. Your application is pending admin approval.',
            'user' => [
                'public_id' => $specialist->public_id,
                'name' => $specialist->name,
                'email' => $specialist->email,
                'role' => $specialist->role,
                'status' => $specialist->status,
            ],
            'specialist_profile' => [
                'doctor_number' => $specialist->specialistProfile->doctor_number,
                'room_number' => $specialist->specialistProfile->room_number,
                'bio' => $specialist->specialistProfile->bio,
                'approval_status' => $specialist->specialistProfile->approval_status,
                'specialty' => [
                    'id' => $specialist->specialistProfile->specialty->id,
                    'name' => $specialist->specialistProfile->specialty->name,
                ],
            ],
        ], 201);
    }

    
public function profile(Request $request): JsonResponse
{
    $specialist = $request->user()
        ->load('specialistProfile.specialty')
        ->specialistProfile;

    return response()->json([
        'specialist' => new SpecialistResource($specialist),
    ]);
}}