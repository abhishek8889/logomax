<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Authentication\AuthenticateController;
=======
use App\Http\Controllers\Admin\DashboardController;
>>>>>>> 33ea5a377ed1cc30c8f7508ab107a3a3e65ca808
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

<<<<<<< HEAD
Route::get('/', function () {
    return view('welcome');
});

/** Authentocations */
Route::get('/login', [AuthenticationController::class,'login']);
Route::post('/login-process', [AuthenticationController::class, 'loginProcess']);

Route::group(['middleware'=>['auth','Admin']],function(){

    /** All Admin dashbord data */

 });
=======
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin-dashboard',[DashboardController::class,'index'])->name('/admin-dashboard');
>>>>>>> 33ea5a377ed1cc30c8f7508ab107a3a3e65ca808
