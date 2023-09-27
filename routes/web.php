<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Designer\DesignerDashController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\TestController;
// ::::::::::::: User Route ::::::::::::::
use App\Http\Controllers\User\Home\HomeController;
use App\Http\Controllers\User\SiteMetaPages\MetaPagesController;
use App\Http\Controllers\User\Blog\BlogController;

use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Events\RegisterNotificationEvent;
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
Route::get('test-check',[TestController::class,'index']);



Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/about-us',[MetaPagesController::class,'aboutUs'])->name('about-us');
Route::get('/reviews',[MetaPagesController::class,'reviews'])->name('reviews');
Route::get('/blogs',[BlogController::class,'index'])->name('blogs');
Route::get('/blogs-details/{slug}',[BlogController::class,'blogDetail']);


/** Authentications */
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
    
    //categories
    Route::get('/admin-dashboard/categories-list',[CategoriesController::class,'index']);
    Route::get('/admin-dashboard/categories-list/add-new/{id?}',[CategoriesController::class,'addCategories']);
    Route::post('/admin-dashboard/categories-list/addproc',[CategoriesController::class,'addproc'])->name('add-category');
    Route::get('/admin-dashboard/categories-list/delete/{id}',[CategoriesController::class,'delete']);
    Route::get('/admin-dashboard/categories-get',[CategoriesController::class,'getCategories']);


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
