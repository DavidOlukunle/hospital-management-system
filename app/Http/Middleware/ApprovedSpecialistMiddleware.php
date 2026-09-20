<?php

namespace App\Http\Middleware;

use App\Models\SpecialistProfile;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovedSpecialistMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        $specialistProfile = $user?->specialistProfile;

        if (
            !$specialistProfile ||
            $specialistProfile->approval_status !==
                SpecialistProfile::APPROVAL_APPROVED
        ) {
            return response()->json([
                'message' => 'Your specialist account has not been approved yet.',
            ], 403);
        }

        return $next($request);
    }
}