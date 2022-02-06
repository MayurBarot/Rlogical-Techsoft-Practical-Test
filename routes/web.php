<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SchedulesController;
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


    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);

//Admin and User form route
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/user', [LoginController::class,'showUserLoginForm']);

//Admin and User login post route
Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/user', [LoginController::class,'userLogin']);


/* use user guard as middleware - All USERS ROUTES */

Route::group(['middleware' => 'auth:user'], function () {
    Route::resource('/schedules',SchedulesController::class);
    Route::get('/schedules_meeting',[SchedulesController::class,'schedules_meeting']);
});

/*END USERS ROUTES */

//use admin guard as middleware - All ADMIN ROUTES

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin',[SchedulesController::class,'admin_schedules_list']);
    Route::get('/adminApproved/{id}',[SchedulesController::class,'admin_schedules_approved']);
    Route::get('/adminRejected/{id}',[SchedulesController::class,'admin_schedules_rejected']);
});

/*END ADMINS ROUTES */

/* logout  route*/
Route::get('logout', [LoginController::class,'logout']);