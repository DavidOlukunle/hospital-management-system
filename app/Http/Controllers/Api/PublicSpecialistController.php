<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpecialistProfile;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SpecialistResource;

class PublicSpecialistController extends Controller
{
    public function index(): JsonResponse
{
    $specialists = SpecialistProfile::with([
        'user',
        'specialty',
    ])
        ->where(
            'approval_status',
            SpecialistProfile::APPROVAL_APPROVED
        )
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'specialists' => SpecialistResource::collection($specialists),
    ]);
}

    public function show(string $publicId): JsonResponse
{
    $specialist = SpecialistProfile::with([
        'user',
        'specialty',
    ])
        ->where(
            'approval_status',
            SpecialistProfile::APPROVAL_APPROVED
        )
        ->whereHas('user', function ($query) use ($publicId) {
            $query->where('public_id', $publicId);
        })
        ->firstOrFail();

    return response()->json([
        'specialist' => new SpecialistResource($specialist),
    ]);
}
}