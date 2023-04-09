<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index']);

Route::get('/appointments',[HomeController::class,'appointments']);

Route::post('appointment/create',[HomeController::class,'createAppointment']);

Route::get('/cancel_appointment/{id}',[HomeController::class,'deleteAppointment']);

Route::get('/register', [UserController::class, 'create']);

Route::get('/login', [UserController::class, 'loginPage'])->name('login')->middleware('guest');



Route::post('/users', [UserController::class, 'register']);

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout']);

 
Route::get('Admin/dashboard', [AdminController::class, 'adminDashboard'])->middleware('auth');

Route::post('Admin/register', [AdminController::class, 'store']);

Route::get('Admin/add-specialist', [AdminController::class, 'addSpecialist'])->middleware('auth');

Route::get('Admin/showAppointments', [AdminController::class, 'showAppointments'])->middleware('auth');

// Route::get('Admin/performAction/{action}', [AdminController::class, 'performAppointmentAction']);

Route::get('Admin/approved/{uuid}', [AdminController::class, 'approveAppointment']);

Route::get('Admin/canceled/{uuid}', [AdminController::class, 'cancelAppointment']);

Route::get('Admin/all-specialists', [AdminController::class, 'showSpecialists'])->middleware('auth');

Route::delete('Admin/delete_specialist/{specialist}', [AdminController::class, 'deleteSpecialist']);

Route::get('Admin/edit_specialist/{id}', [AdminController::class, 'editPage']);

Route::put('Admin/update-specialist/{id}', [AdminController::class, 'updateSpecialist']);


