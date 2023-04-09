<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::controller(UserController::class)->group(function () {
    Route::post('/users','register');
    Route::post('/users/authenticate', 'authenticate');
    Route::post('/logout', 'logout');
    Route::get('/login', 'loginPage')->name('login')->middleware('guest');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/appointments', 'appointments');
    Route::post('appointment/create', 'createAppointment');
    Route::get('/cancel_appointment/{id}', 'deleteAppointment');
    Route::get('/register', 'create');
});


