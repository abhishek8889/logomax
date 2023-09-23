<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Designer\DesignerDashController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Front\FrontController;
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

// Route::get('/', function () {
//     // return view('welcome');
//     return  'Welcome to your application';
// });

////front rotues

Route::get('/',[FrontController::class,'index']);
Route::get('/about-us',[FrontController::class,'aboutus']);
Route::get('/review',[FrontController::class,'review']);
Route::get('/blog',[FrontController::class,'blog']);







/** Authentocations */
// Route::get('/login', [AuthenticationController::class,'login'])->name('login');

Route::get('/admin-login', function () {
    return view('authentication.admin_login');
});
Route::get('/login', [AuthenticationController::class,'login'])->name('login');
Route::post('/login-process', [AuthenticationController::class, 'loginProcess']);

Route::get('/register', [AuthenticationController::class,'register']);
Route::post('/register-process',[AuthenticationController::class,'registerProcess']);
Route::get('/register-verify/{token}', [AuthenticationController::class,'registerVerify']);

/** All Admin dashbord data */
Route::group(['middleware'=>['auth','Admin']],function(){
    Route::get('/admin-dashboard',[AdminDashController::class,'index']);
    Route::get('/admin-dashboard/users-list',[UsersController::class,'index']);
    Route::post('/admin-dashboard/users-list/approve-user',[UsersController::class,'approveUser']);
});


/** All Designer dashbord data */
Route::group(['middleware'=>['auth','Designer']],function(){
    Route::get('/designer-dashboard',[DesignerDashController::class,'index']);
});

/** Log-out Route */
Route::get('/logout', [AuthenticationController::class, 'logout']);

Route::get('/mail', function () {
    return view('Mail.register_confirmation.index');
});
