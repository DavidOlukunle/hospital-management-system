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

Route::get('/register',[UserController::class, 'create']);

Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');



Route::post('/users',[UserController::class,'register']);

Route::post('/users/authenticate',[UserController::class,'authenticate']);

Route::post('/logout',[UserController::class,'logout']);

 
Route::get('/home',[AdminController::class,'index'])->middleware('auth');

Route::post('Admin/register',[AdminController::class,'store']);

Route::get('/addDoctors',[AdminController::class,'addDoctors'])->middleware('auth');

Route::get('/showAppointments',[AdminController::class,'showAppointments'])->middleware('auth');

Route::get('/approved/{id}',[AdminController::class,'approve_appointment']);

Route::get('/canceled/{id}',[AdminController::class,'cancel_appointment']);

Route::get('/view_all_doctors',[AdminController::class,'show_doctors'])->middleware('auth');

Route::get('/delete_doctor/{id}',[AdminController::class,'delete_doctor']);

Route::get('/edit_doctor/{id}',[AdminController::class,'edit_page']);

Route::put('Admin/edit_doctor/{id}',[AdminController::class,'update_doctor']);


