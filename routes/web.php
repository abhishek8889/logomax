<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthenticationController;
use App\Http\Controllers\Authentication\GoogleController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Designer\DesignerDashController;
use App\Http\Controllers\Designer\AccountSetting;
use App\Http\Controllers\Designer\Logo\DesginerLogoController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\TestController;
// ::::::::::::: User Route ::::::::::::::
use App\Http\Controllers\User\Home\HomeController;
use App\Http\Controllers\User\SiteMetaPages\MetaPagesController;
use App\Http\Controllers\User\Blog\BlogController;

use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\Tags\TagsController;
use App\Http\Controllers\Admin\Logo\LogosController;

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


//googlelogin
Route::get('authorized/google',[GoogleController::class,'redirecttogoogle']);
Route::get('authorized/google/callback',[GoogleController::class,'handleGoogleCallback']);

Route::get('authorized/facebook',[GoogleController::class,'redirecttofacebook']);
Route::get('authorized/facebook/callback',[GoogleController::class,'handleFacebookCallback']);

Route::get('/register', [AuthenticationController::class,'register']);
Route::post('/register-process',[AuthenticationController::class,'registerProcess']);
Route::get('/register-verify/{token}', [AuthenticationController::class,'registerVerify']);

/** All Admin dashbord data */
Route::group(['middleware'=>['auth','Admin']],function(){
    Route::get('/admin-dashboard',[AdminDashController::class,'index']);
    Route::get('/admin-dashboard/designers-list',[UsersController::class,'index']);
    Route::get('/admin-dashboard/guests-list',[UsersController::class,'simpleuser']);
    Route::post('/admin-dashboard/users-list/approve-user',[UsersController::class,'approveUser']);
    Route::get('read-notification/{notification_id}',[AdminDashController::class,'readNotification']);
    //categories
    Route::get('/admin-dashboard/categories-list',[CategoriesController::class,'index']);
    Route::get('/admin-dashboard/categories-list/add-new/{id?}',[CategoriesController::class,'addCategories']);
    Route::post('/admin-dashboard/categories-list/addproc',[CategoriesController::class,'addproc'])->name('add-category');
    Route::get('/admin-dashboard/categories-list/delete/{id}',[CategoriesController::class,'delete']);
    Route::get('/admin-dashboard/categories-get',[CategoriesController::class,'getCategories']);

    //admintags
    Route::get('admin-dashboard/tags',[TagsController::class,'addtags']);
    Route::post('admin-dashboard/addtags/submitprocc',[TagsController::class,'submitProc']);
    Route::get('admin-dashboard/tags/delete/{id}',[TagsController::class,'delete']);

    //adminlogos
    Route::get('admin-dashboard/logosrequest',[LogosController::class,'index']);
    Route::get('admin-dashboard/approvedlogos',[LogosController::class,'approvedLogos']);

    Route::post('admin-dashboard/updatestatus',[LogosController::class,'updateStatus']);

});


/** All Designer dashbord data */
Route::group(['middleware'=>['auth','Designer']],function(){
    Route::get('/designer-dashboard',[DesignerDashController::class,'index']);
    Route::get('/designer-dashboard/setting',[AccountSetting::class,'index']);
    Route::post('/designer-dashboard/setting/submitProc',[AccountSetting::class,'update']);

    Route::get('designer-dashboard/mylogos',[DesginerLogoController::class,'index']);
    Route::get('designer-dashboard/uploadlogo',[DesginerLogoController::class,'upload']);
    Route::post('designer-dashboard/uploadprocc',[DesginerLogoController::class,'uploadProc']);

    Route::post('designer-dashboard/addtag',[DesginerLogoController::class,'addtag']);
    Route::post('designer-dashboard/deleteimage',[DesginerLogoController::class,'deleteimage']);

});

/** Log-out Route */
Route::get('/logout', [AuthenticationController::class, 'logout']);

Route::get('/mail', function () {
    return view('Mail.register_confirmation.index');
});
