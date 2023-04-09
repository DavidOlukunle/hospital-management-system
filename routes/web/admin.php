<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::prefix('admin')->controller(AdminController::class)->group(function() {
    Route::middleware('auth')->group(function() {
        Route::get('/dashboard', 'adminDashboard');
        Route::get('/add-specialist', 'addSpecialist');
        Route::get('/showAppointments', 'showAppointments');
        Route::get('/dashboard', 'adminDashboard');
        Route::get('/add-specialist', 'addSpecialist');
        Route::get('/showAppointments', 'showAppointments');
        Route::get('/all-specialists', 'showSpecialists');
    });
    
    Route::post('/register', 'store');
    Route::get('/approved/{uuid}', 'approveAppointment');
    Route::get('/canceled/{uuid}', 'cancelAppointment');
    Route::delete('/delete_specialist/{specialist}', 'deleteSpecialist');
    Route::get('/edit_specialist/{id}', 'editPage');
    Route::put('/update-specialist/{id}', 'updateSpecialist');

});



