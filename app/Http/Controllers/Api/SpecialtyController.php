<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\JsonResponse;

class SpecialtyController extends Controller
{
    public function index(): JsonResponse
    {
        $specialties = Specialty::query()
            ->select([
                'id',
                'name',
                'description',
            ])
            ->orderBy('name')
            ->get();

        return response()->json([
            'specialties' => $specialties,
        ]);
    }
}

