<?php

namespace App\Http\Controllers\Api\Admin;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
{
    $users = User::with([
        'specialistProfile.specialty',
    ])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'users' => UserResource::collection($users),
    ]);
}
}