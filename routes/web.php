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
use App\Http\Controllers\User\Logo\FrontLogoController;

use App\Http\Controllers\Admin\Categories\CategoriesController;
use App\Http\Controllers\Admin\Tags\TagsController;
use App\Http\Controllers\Admin\Logo\LogosController;
use App\Http\Controllers\Admin\Blog\AdminBlogController;
use App\Http\Controllers\Admin\Style\AdminStyleController;
use App\Http\Controllers\Admin\Blog\BlogCategoryController;
use App\Http\Controllers\Admin\SpecialDesigner\SpecialDesignerController;
use App\Http\Controllers\User\Checkout\CheckoutController;
use App\Http\Controllers\User\Dashboard\UserDashboardController;


use App\Http\Controllers\BasicController;

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

//  USER PANEL 
Route::group(['middleware'=>['EnsureUser']],function(){
    Route::get('test-check',[TestController::class,'index']);
    //  :::::::::::::::::::::  Basic Controller ::::::::::::::::::::::::: 
    Route::get('read-notification/{notification_id}',[BasicController::class,'readNotification']);

    Route::get('/',[HomeController::class,'index'])->name('/');
    Route::get('/about-us',[MetaPagesController::class,'aboutUs'])->name('about-us');
    Route::get('/reviews',[MetaPagesController::class,'reviews'])->name('reviews');
    Route::get('/blogs',[BlogController::class,'index'])->name('blogs');
    Route::get('/blogs-details/{slug}',[BlogController::class,'blogDetail']);
    Route::get('/logos-search',[FrontLogoController::class,'index']);
    Route::get('/logos-detail/{slug}',[FrontLogoController::class,'logodetail']);

    Route::get('/logos/checkout/{slug}',[CheckoutController::class,'checkoutView']);
    Route::post('logo-checkout',[CheckoutController::class,'checkoutProcess']);

    Route::get('logo-download/{slug}',[FrontLogoController::class,'download_page']);

    Route::post('logo-filter',[FrontLogoController::class,'logoFilter']);

    Route::post('blog-search',[BlogController::class,'blogsearch']);

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

    ///// User Dashboard route :::::::
    Route::get('/user-orders', [UserDashboardController::class,'userOrders'])->name('dashboard');

    
});

///////////////   USER PANEL ROUTES END   //////////////////////////////////

/** /////////////////   All Admin dashbord data //////////////////////////*/

Route::group(['middleware'=>['auth','Admin']],function(){
    Route::get('/admin-dashboard',[AdminDashController::class,'index'])->name('admin-dashboard');
    Route::get('/admin-dashboard/designers-list',[UsersController::class,'index'])->name('designer-list');
    Route::get('/admin-dashboard/designers-view/{id}',[UsersController::class,'designerview'])->name('designer-view');
    Route::get('/admin-dashboard/guests-list',[UsersController::class,'simpleuser'])->name('guest-list');
    Route::post('/admin-dashboard/users-list/approve-user',[UsersController::class,'approveUser']);
    // Route::get('read-notification/{notification_id}',[AdminDashController::class,'readNotification']);
    Route::get('admin-dashboard/designers-list/delete/{id}',[UsersController::class,'delete']);
    //categories
    Route::get('/admin-dashboard/categories-list',[CategoriesController::class,'index'])->name('categories');
    Route::get('/admin-dashboard/categories-list/add-new/{id?}',[CategoriesController::class,'addCategories'])->name('add-categories');
    Route::post('/admin-dashboard/categories-list/addproc',[CategoriesController::class,'addproc'])->name('add-category');
    Route::get('/admin-dashboard/categories-list/delete/{id}',[CategoriesController::class,'delete']);
    Route::get('/admin-dashboard/categories-get',[CategoriesController::class,'getCategories']);

    //admintags
    Route::get('admin-dashboard/tags',[TagsController::class,'addtags'])->name('tags');
    Route::post('admin-dashboard/addtags/submitprocc',[TagsController::class,'submitProc']);
    
    Route::post('admin-dashboard/addtags/addProcc',[TagsController::class,'addtagProcc']); //for input add
    Route::get('admin-dashboard/tags/delete/{id}',[TagsController::class,'delete']); 

    //adminlogos
    Route::get('admin-dashboard/logos-list',[LogosController::class,'index'])->name('logos-requests');
    Route::get('admin-dashboard/logo-detail/{slug}',[LogosController::class,'logodetail'])->name('logo-detail');
    Route::get('admin-dashboard/approved-logos',[LogosController::class,'approvedLogos'])->name('approved-logos');
    Route::get('admin-dashboard/disapproved-logos',[LogosController::class,'disapprovedLogos'])->name('disapproved-logos');
    Route::post('admin-dashboard/updatestatus',[LogosController::class,'updateStatus']);
    
    // Logo Facilities :
    Route::get('admin-dashboard/logo-facilities',[LogosController::class,'logoFacilities']);
    Route::post('admin-dashboard/logo-facilities',[LogosController::class,'logoFacilitiesAdd']);
    Route::get('admin-dashboard/logo-options/{id?}',[LogosController::class,'additionalOptions']);
    Route::post('admin-dashboard/logo-optionssave',[LogosController::class,'additionalOptionsSave']);
    Route::get('admin-dashboard/delete-options/{id}',[LogosController::class,'deleteAdditionlaOption']);

    //adminblogs
    Route::get('admin-dashboard/blogs/category',[BlogCategoryController::class,'index'])->name('blog-category');
    Route::post('admin-dashboard/blogs/categoryadd',[BlogCategoryController::class,'addprocc']);
    Route::get('admin-dashboard/blogs/categiory/delete/{id}',[BlogCategoryController::class,'delete']);

    Route::get('admin-dashboard/blog-list',[AdminBlogController::class,'index'])->name('blogs-list');
    Route::get('admin-dashboard/blogs/add',[AdminBlogController::class,'add'])->name('add-blogs');
    Route::get('admin-dashboard/blogs/edit/{slug}',[AdminBlogController::class,'edit'])->name('edit-blogs');
    Route::post('admin-dashboard/blogs/addProcc',[AdminBlogController::class,'addProcc']);
    Route::get('admin-dashboard/blogs/delete/{id}',[AdminBlogController::class,'delete']);

    //Styles
    Route::get('admin-dashboard/styles',[AdminStyleController::class,'index'])->name('styles');
    Route::post('admin-dashboard/styles/addProcc',[AdminStyleController::class,'addProcc']);
    Route::get('admin-dashboard/styles/delete/{id}',[AdminStyleController::class,'delete']);

    // Special Designer 
    Route::get('admin-dashboard/add-special-designer',[SpecialDesignerController::class,'addSpecialDesigner'])->name('add-special-desinger');
    Route::post('admin-dashboard/add-special-designer',[SpecialDesignerController::class,'addSpecialDesignerProcess']);
    Route::get('/admin-dashboard/special-designer-list',[SpecialDesignerController::class,'specialDesignerList'])->name('special-desinger-list');
});
/////////////////////////// ADMIN ROUTES END ///////////////////////////////

/////////////////////////// DESIGNER ROUTES ////////////////////////////////
/** All Designer dashbord data */

Route::group(['middleware'=>['auth','Designer']],function(){
    Route::get('/designer-dashboard',[DesignerDashController::class,'index'])->name('designer-dashboard');
    Route::get('/designer-dashboard/setting',[AccountSetting::class,'index'])->name('account-setting');
    Route::get('/designer-dashboard/change-password',[AuthenticationController::class,'changePassword']);
    Route::post('/designer-dashboard/change-password-procc',[AuthenticationController::class,'changePasswordProcc']);
    
    Route::post('/designer-dashboard/setting/submitProc',[AccountSetting::class,'update']);

    Route::get('designer-dashboard/mylogos',[DesginerLogoController::class,'index'])->name('my-logos');
    Route::get('designer-dashboard/uploadlogo',[DesginerLogoController::class,'upload'])->name('upload-logo');
    Route::post('designer-dashboard/uploadprocc',[DesginerLogoController::class,'uploadProc']);

    Route::post('designer-dashboard/addtag',[DesginerLogoController::class,'addtag']);
    Route::post('designer-dashboard/deleteimage',[DesginerLogoController::class,'deleteimage']);

});

/////////////////////////// DESIGNER ROUTES END ////////////////////////////////


/** Log-out Route */
Route::get('/logout', [AuthenticationController::class, 'logout']);

Route::get('/mail', function () {
    return view('Mail.register_confirmation.index');
});
