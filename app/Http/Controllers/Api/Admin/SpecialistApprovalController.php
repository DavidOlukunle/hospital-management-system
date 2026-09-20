<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecialistProfile;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SpecialistResource;

class SpecialistApprovalController extends Controller
{
    public function index(): JsonResponse
{
    $specialists = SpecialistProfile::with([
        'user',
        'specialty',
    ])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'specialists' => SpecialistResource::collection($specialists),
    ]);
}

    public function approve(string $publicId): JsonResponse
{
    $specialist = SpecialistProfile::with('user')
        ->whereHas('user', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })
        ->firstOrFail();
    if (
        $specialist->approval_status === SpecialistProfile::APPROVAL_APPROVED
    ) {
        return response()->json([
            'message' => 'Specialist is already approved.',
        ], 422);
    }

    $specialist->update([
        'approval_status' => SpecialistProfile::APPROVAL_APPROVED,
        'approved_at' => now(),
    ]);

    return response()->json([
        'message' => 'Specialist approved successfully.',
        'specialist' => [
            'public_id' => $specialist->user->public_id,
            'name' => $specialist->user->name,
            'email' => $specialist->user->email,
            'approval_status' => $specialist->approval_status,
            'approved_at' => $specialist->approved_at,
        ],
    ]);
}

public function reject(string $publicId): JsonResponse
{
    $specialist = SpecialistProfile::with('user')
        ->whereHas('user', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })
        ->firstOrFail();

    if (
        $specialist->approval_status === SpecialistProfile::APPROVAL_REJECTED
    ) {
        return response()->json([
            'message' => 'Specialist is already rejected.',
        ], 422);
    }

    $specialist->update([
        'approval_status' => SpecialistProfile::APPROVAL_REJECTED,
        'approved_at' => null,
    ]);

    return response()->json([
        'message' => 'Specialist rejected successfully.',
        'specialist' => [
            'public_id' => $specialist->user->public_id,
            'name' => $specialist->user->name,
            'email' => $specialist->user->email,
            'approval_status' => $specialist->approval_status,
            'approved_at' => $specialist->approved_at,
        ],
    ]);
}

}