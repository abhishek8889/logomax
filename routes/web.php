<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthenticateController;
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
    return view('welcome');
});

/** Authentocations */
Route::get('/login', [AuthenticationController::class,'login']);
Route::post('/login-process', [AuthenticationController::class, 'loginProcess']);

Route::group(['middleware'=>['auth','Admin']],function(){

    /** All Admin dashbord data */

 });
