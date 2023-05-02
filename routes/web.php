<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Admin\AdminDashController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return  'Welcome to your application';
});

/** Authentocations */
Route::get('/login', [AuthenticationController::class,'login'])->name('login');
Route::post('/login-process', [AuthenticationController::class, 'loginProcess']);


    /** All Admin dashbord data */
    Route::group(['middleware'=>['auth','Admin']],function(){
Route::get('/admin-dashboard',[AdminDashController::class,'index']);
    });
/** Log-out Route */
Route::get('/logout', [AuthenticationController::class, 'logout']);


