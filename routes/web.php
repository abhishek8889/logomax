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
use App\Http\Controllers\Admin\Revision\RevisionController;
use App\Http\Controllers\Admin\Reviews\ReviewsController;
use App\Http\Controllers\Admin\SiteMeta\SiteMetaController;

use App\Http\Controllers\BasicController;

use App\Events\RegisterNotificationEvent;
use App\Http\Controllers\Admin\SiteContent\SiteContentController;
//  ::::::::::::::::::: Special Designer :::::::::::::::::
use App\Http\Controllers\SpecialDesigner\Dashboard\SpecialDesignerDashboardController;
use App\Http\Controllers\SpecialDesigner\Task\TaskController;
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
   
    //  :::::::::::::::::::::  Basic Controller ::::::::::::::::::::::::: 

    Route::get('/',[HomeController::class,'index'])->name('/');
    Route::get('/about-us',[MetaPagesController::class,'aboutUs'])->name('about-us');
    Route::get('/reviews',[MetaPagesController::class,'reviews'])->name('reviews');
    Route::get('/support',[MetaPagesController::class,'support'])->name('support');

    Route::get('/blogs',[BlogController::class,'index'])->name('blogs');
    Route::get('/blogs-details/{slug}',[BlogController::class,'blogDetail']);
    Route::get('/logos/{slug}',[FrontLogoController::class,'index']);
    Route::get('/logo/{slug}',[FrontLogoController::class,'logodetail']);

    Route::get('/logos/checkout/{slug}',[CheckoutController::class,'checkoutView']);
    Route::post('logo-checkout',[CheckoutController::class,'checkoutProcess']);

    Route::get('logo-download/{slug}',[FrontLogoController::class,'download_page']);

    Route::post('logo-filter',[FrontLogoController::class,'logoFilter']);

    Route::post('blog-search',[BlogController::class,'blogsearch']);


    /* term and conditions: */
  
    /** Authentications */
    // Route::get('/login', [AuthenticationController::class,'login'])->name('login');
    Route::get('/login', [AuthenticationController::class,'loginNew']);
    Route::get('/register', [AuthenticationController::class,'registerNew']);
    Route::get('/account-recovery', [AuthenticationController::class,'forgotPassword']);
    Route::post('/send-recovery-email', [AuthenticationController::class,'sendRecoveryEmail']);
    Route::get('/recover-your-pass/{token}', [AuthenticationController::class,'recoverYourPass']);
    Route::post('/change-pass', [AuthenticationController::class,'changePassProcess']);
    
    
    Route::get('/admin-login', function () {
        return view('authentication.admin_login');
    });

    Route::get('/login-old', [AuthenticationController::class,'login'])->name('login');
    Route::post('/login-process', [AuthenticationController::class, 'loginProcess']);


    //googlelogin
    Route::get('authorized/google',[GoogleController::class,'redirecttogoogle']);
    Route::get('authorized/google/callback',[GoogleController::class,'handleGoogleCallback']);

    Route::get('authorized/facebook',[GoogleController::class,'redirecttofacebook']);
    Route::get('authorized/facebook/callback',[GoogleController::class,'handleFacebookCallback']);

    Route::get('/register-old', [AuthenticationController::class,'register']);
    Route::post('/register-process',[AuthenticationController::class,'registerProcess']);
    Route::get('/register-verify/{token}', [AuthenticationController::class,'registerVerify']);

    ///// User Dashboard route :::::::
    Route::get('/user-orders', [UserDashboardController::class,'userOrders']);
    Route::get('/order-details/{order_num}', [UserDashboardController::class,'orderDetail']);
    Route::get('/download-logo/{order_num}', [UserDashboardController::class,'downloadLogo']);
    Route::get('/request-for-revision', [UserDashboardController::class,'requestForRevision']);
    Route::get('/approve-logo/{complete_task_id}',[UserDashboardController::class,'approveLogo']);
    Route::get('/disapprove-logo/{complete_task_id}',[UserDashboardController::class,'disapproveLogo']);

    // Download revised logo 
    Route::get('/downloadProcess/{complete_task_id}',[UserDashboardController::class,'downloadProcess']);


    // Route::get('/TermsAndconditions', function () {
    //     return view('users.meta-pages.terms&conditions');
    // });
    Route::get('/terms-and-conditions', [UserDashboardController::class,'termsAndConditions']);

    ///////////////////////// Simple user Dashboard Routes /////////////////////////////////
    
        Route::get('/dashboard',[UserDashboardController::class, 'UserDashboardIndex']);
        Route::get('/favourites',[UserDashboardController::class, 'UserFavouritelist']);
        Route::get('/logo',[UserDashboardController::class, 'UserLogoslist']);
        Route::get('/configuration',[UserDashboardController::class, 'UserConfiguration']);
        Route::get('/subscriptions',[UserDashboardController::class, 'UserSubscription']);
        Route::get('/messages',[UserDashboardController::class, 'UserMessages']);

    ////////////////////////////////////////////////////////////////////////////////////////
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
    Route::get('admin-dashboard/sold-logos',[LogosController::class,'soldLogos'])->name('sold-logos');
    
    Route::post('admin-dashboard/updatestatus',[LogosController::class,'updateStatus']);
    
    // Logo Facilities :
    Route::get('admin-dashboard/logo-facilities',[LogosController::class,'logoFacilities'])->name('logo-facilities');
    Route::post('admin-dashboard/logo-facilities',[LogosController::class,'logoFacilitiesAdd']);
    Route::get('admin-dashboard/logo-facilities-dlt/{id}',[LogosController::class,'logoFacilitiesDelete']);
    
    Route::get('admin-dashboard/logo-options/{id?}',[LogosController::class,'additionalOptions'])->name('additional-options');
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

    // Logo Revision Routes :
    Route::get('admin-dashboard/revision-request',[RevisionController::class,'revisionRequest'])->name('revision-request');
    Route::get('admin-dashboard/request-detail/{request_id}',[RevisionController::class,'revisionRequestDetail'])->name('revision-request-detail');

    // Revision Requests are assigned
    Route::get('admin-dashboard/on-revision',[RevisionController::class,'onRevisionTask'])->name('on-revision');
    Route::get('admin-dashboard/on-revision-detail/{revision_id}',[RevisionController::class,'onRevisionDetail'])->name('on-revision-detail');

    // Revised Logo 
    Route::get('admin-dashboard/revised-logo-list',[RevisionController::class,'revisedLogoList'])->name('revised-logos');
    Route::get('admin-dashboard/revised-logo/{revision_id}',[RevisionController::class,'revisedLogoDetail'])->name('revised-logos-detail');

    //SiteMeta
    Route::get('admin-dashboard/sitemeta/',[SiteMetaController::class,'index'])->name('site-meta');
    Route::get('admin-dashboard/sitemeta/add/{id?}',[SiteMetaController::class,'addMeta'])->name('site-meta-update');
    Route::post('admin-dashboard/sitemeta/addprocc',[SiteMetaController::class,'addProcc']);
    Route::get('admin-dashboard/sitemeta/delete/{id}',[SiteMetaController::class,'sitemetadelete']);


    //Support Meta
    Route::get('admin-dashboard/site-meta/support/{id?}',[SiteMetaController::class,'SupportContent'])->name('support-meta');
    Route::post('admin-dashboard/site-meta/support/submitProcc',[SiteMetaController::class,'supportSubmit']);
    Route::get('admin-dashboard/site-meta/support/delete/{id}',[SiteMetaController::class,'supportmetaDelete']);
    
   


    // :::::::::::::::::: Assign work to special designer :::::::::::::::::
    Route::post('assign-work',[RevisionController::class,'assignToSpecialDesigner']);
    
    // Reviews System 
    Route::get('/admin-dashboard/edit-review/{id?}',[ReviewsController::class,'editReview'])->name('update-review');
    Route::post('/admin-dashboard/add-review-process',[ReviewsController::class,'addReviewProcc']);
    Route::get('admin-dashboard/review-list',[ReviewsController::class,'reviewlist'])->name('review-list');
    Route::post('admin-dashboard/update-review-status',[ReviewsController::class,'updatestatus']);
    Route::get('admin-dashboard/review/delete/{id}',[ReviewsController::class,'delete']);


    // Site Content Routes ::::::::::::::::::::::::::::::::::::::::::::::::
    Route::get('/admin-dashboard/site-content/add-about-content',[SiteContentController::class,'aboutContent'])->name('about-meta');
    Route::post('/admin-dashboard/about-page-content/addprocess',[SiteContentController::class,'aboutAddProcess']);

    Route::get('admin-dashboard/site-content/support',[SiteContentController::class,'supportContent'])->name('support-setting');
    Route::post('admin-dashboard/site-content/support/submit',[SiteContentController::class,'supportContentSubmit']);

    // Site configuration page :::
    Route::get('/admin-dashboard/site-setting',[SiteContentController::class,'siteConfiguration'])->name('site-setting');
    Route::post('/admin-dashboard/update-site-setting',[SiteContentController::class,'updateSiteConfiguration']);
    Route::post('/update-image',[SiteContentController::class,'updateImage']);
    //// about page configuration 
    Route::get('/admin-dashboard/about-page-setting',[SiteContentController::class,'aboutPageSetting'])->name('about-setting');
    Route::post('/admin-dashboard/about-page-update',[SiteContentController::class,'aboutPageupdate']);

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

/////////////////////////// SPECIAL DESIGNER ROUTES  ///////////////////////////
Route::get('special-designer/dashboard/',[SpecialDesignerDashboardController::class,'index']);
Route::get('special-designer/task-list',[TaskController::class,'taskList']);
Route::get('special-designer/task-detail/{task_id}',[TaskController::class,'taskDetail']);

// Complete task of special designer
Route::get('special-designer/complete-task',[TaskController::class,'completeTask']);


Route::post('special-designer/upload-process',[TaskController::class,'uploadProc']);
Route::post('special-designer/upload-icon',[TaskController::class,'uploadIcon']);

Route::post('special-designer/delete-image',[TaskController::class,'deleteimage']);

// Route::post('/store', [TaskController::class,'store'])->name('store');
// Route::post('uploads', [TaskController::class,'uploads'])->name('uploads');


/////////////////////////// SPECIAL DESIGNER END  ///////////////////////////

/**  ::::::::::::::::: Basic Routes :::::::::::::::  */
Route::get('/logout', [AuthenticationController::class, 'logout']);

Route::get('/mail', function () {
    return view('Mail.register_confirmation.index');
});

Route::get('read-notification/{notification_id}',[BasicController::class,'readNotification']);
Route::get('download-file/{media_id}',[BasicController::class,'downloadFile']);
Route::post('add-to-wishlist',[BasicController::class,'addToWishlist']);

Route::get('test-check',[TestController::class,'index']);
// Route::get('logos?{slug}',function(){
//     return "hello";
// });