<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SpecialistController;
use App\Http\Controllers\Api\Admin\SpecialistApprovalController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\PublicSpecialistController;
use App\Http\Controllers\Api\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\SpecialtyController;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});

Route::get(
    '/specialties',
    [SpecialtyController::class, 'index']
);

Route::get(
    '/specialists',
    [PublicSpecialistController::class, 'index']
);

Route::get(
    '/specialists/{publicId}',
    [PublicSpecialistController::class, 'show']
);


Route::post(
    '/specialists/register',
    [SpecialistController::class, 'register']
);

Route::middleware(['auth:sanctum', 'role:ADMIN'])
    ->prefix('admin')
    ->group(function () {
        Route::get(
            '/specialists',
            [SpecialistApprovalController::class, 'index']
        );

        Route::post(
            '/specialists/{id}/approve',
            [SpecialistApprovalController::class, 'approve']
        );

        Route::post(
    '/specialists/{id}/reject',
    [SpecialistApprovalController::class, 'reject']
);

Route::get(
    '/appointments',
    [AdminAppointmentController::class, 'index']
);

Route::get(
    '/users',
    [AdminUserController::class, 'index']
);

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
);
    }); 

    
    Route::middleware(['auth:sanctum', 'role:SPECIALIST'])
    ->prefix('specialist')
    ->group(function () {
        Route::get('/profile', [SpecialistController::class, 'profile']);
    });

Route::middleware([
    'auth:sanctum',
    'role:SPECIALIST',
    'approved.specialist',
])
    ->prefix('specialist')
    ->group(function () {
        Route::get(
            '/appointments',
            [AppointmentController::class, 'specialistIndex']
        );

        Route::patch(
            '/appointments/{publicId}/status',
            [AppointmentController::class, 'updateStatus']
        );
    });


    Route::middleware(['auth:sanctum', 'role:PATIENT'])
    ->prefix('patient')
    ->group(function () {
        Route::post(
            '/appointments',
            [AppointmentController::class, 'store']
        );

        Route::get(
            '/appointments',
            [AppointmentController::class, 'patientIndex']
        );

        Route::patch(
    '/appointments/{publicId}/cancel',
    [AppointmentController::class, 'cancel']
);
    }); 



