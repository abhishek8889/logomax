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
use App\Http\Controllers\Admin\Currencies\CurrencyLanguageController;
use App\Http\Controllers\Admin\Tags\TagsController;
use App\Http\Controllers\Admin\Logo\LogosController;
use App\Http\Controllers\Admin\Blog\AdminBlogController;
use App\Http\Controllers\Admin\Discount\AdminDiscountController;
use App\Http\Controllers\Admin\Style\AdminStyleController;
use App\Http\Controllers\Admin\Blog\BlogCategoryController;
use App\Http\Controllers\Admin\SpecialDesigner\SpecialDesignerController;
use App\Http\Controllers\User\Checkout\CheckoutController;
use App\Http\Controllers\User\Dashboard\UserDashboardController;
use App\Http\Controllers\User\Dashboard\ImageCropperController;
use App\Http\Controllers\User\Dashboard\UserMessageController;
use App\Http\Controllers\Admin\Revision\RevisionController;
use App\Http\Controllers\Admin\Reviews\ReviewsController;
use App\Http\Controllers\Admin\SiteMeta\SiteMetaController;
use App\Http\Controllers\Admin\Branches\BranchesController;
use App\Http\Controllers\BasicController;

use App\Events\RegisterNotificationEvent;
use App\Http\Controllers\Admin\SiteContent\SiteContentController;
//  ::::::::::::::::::: Special Designer :::::::::::::::::
use App\Http\Controllers\SpecialDesigner\Dashboard\SpecialDesignerDashboardController;
use App\Http\Controllers\SpecialDesigner\Task\TaskController;
use App\Http\Controllers\SpecialDesigner\Messages\SpecialDesginerMessageController;
use App\Http\Controllers\User\Payments\PaymentController;
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
Route::get('/changelagnuage/{lang}',[BasicController::class,'changeLaguage']);
Route::get('changeCurrency/{curr}',[BasicController::class,'changeCurrency'])->name('change.currency')->withoutMiddleware('SetLocale');

///////////////   USER PANEL ROUTES END   //////////////////////////////////

/** /////////////////   All Admin dashbord data //////////////////////////*/

Route::group(['middleware'=>['auth','Admin']],function(){
    Route::get('/admin-dashboard',[AdminDashController::class,'index'])->name('admin-dashboard');
    
    Route::get('/admin-dashboard/select-lang/{langCode}',[AdminDashController::class,'selectLanguage'])->name('select.lang');
    Route::post('/add-translate-val',[AdminDashController::class,'addTranslateValue'])->name('add.translate.val');
    Route::post('/get-data-in-details',[AdminDashController::class,'getDetail']);

    Route::get('/admin-dashboard/test-lang-admin',[AdminDashController::class,'testLangdata']);
    

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

    Route::get('admin-dashboard/blogs/translate/{slug}',[AdminBlogController::class,'blogTranslate'])->name('blog.translate');
    Route::post('admin-dashboard/blogs/translate',[AdminBlogController::class,'blogTranslateProcess']);

    Route::post('admin-dashboard/blogs/addProcc',[AdminBlogController::class,'addProcc']);
    Route::get('admin-dashboard/blogs/delete/{id}',[AdminBlogController::class,'delete']);

    //Styles
    Route::get('admin-dashboard/styles',[AdminStyleController::class,'index'])->name('styles');
    Route::post('admin-dashboard/styles/addProcc',[AdminStyleController::class,'addProcc']);
    Route::get('admin-dashboard/styles/edit/{slug}',[AdminStyleController::class,'addProcc']);
    Route::get('admin-dashboard/styles/delete/{id}',[AdminStyleController::class,'delete']);

    //branches
    Route::get('admin-dashboard/branches',[BranchesController::class,'index'])->name('branches');
    Route::post('admin-dashboard/branches/addProcc',[BranchesController::class,'addProcc']);
    Route::get('admin-dashboard/branches/delete/{id}',[BranchesController::class,'delete']);

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

    //////////////////////////////////////// ADDING SITE META KEY VALUES //////////////////////////////////////
    //SiteMeta
    Route::get('admin-dashboard/sitemeta/',[SiteMetaController::class,'index'])->name('site-meta');
    Route::get('admin-dashboard/sitemeta/add/{id?}',[SiteMetaController::class,'addMeta'])->name('site-meta-update');
    Route::post('admin-dashboard/sitemeta/addprocc',[SiteMetaController::class,'addProcc']);
    Route::get('admin-dashboard/sitemeta/delete/{id}',[SiteMetaController::class,'sitemetadelete']);


    //Support Meta
    Route::get('admin-dashboard/site-meta/support/{id?}',[SiteMetaController::class,'SupportContent'])->name('support-meta');
    Route::post('admin-dashboard/site-meta/support/submitProcc',[SiteMetaController::class,'supportSubmit']);
    Route::get('admin-dashboard/site-meta/support/delete/{id}',[SiteMetaController::class,'supportmetaDelete']);

    // Home 

    Route::get('/site-content/home',[SiteContentController::class,'homeContentPage']);
    Route::get('/site-content-list/home',[SiteContentController::class,'homeContentList']);

    /////////////////////////////////////////////// END ////////////////////////////////////////////////////////

   ///prices
   Route::get('admin-dashboard/prices',[CurrencyLanguageController::class,'index']);
   Route::get('admin-dashboard/prices/remove/{id}',[CurrencyLanguageController::class,'delete']);
   Route::post('admin-dashboard/prices/addProcc',[CurrencyLanguageController::class,'addPrices']);


    // :::::::::::::::::: Assign work to special designer :::::::::::::::::
    Route::post('assign-work',[RevisionController::class,'assignToSpecialDesigner']);
    
    // Reviews System 
    Route::get('/admin-dashboard/edit-review/{id?}',[ReviewsController::class,'editReview'])->name('update-review');
    Route::post('/admin-dashboard/add-review-process',[ReviewsController::class,'addReviewProcc']);
    Route::get('admin-dashboard/review-list',[ReviewsController::class,'reviewlist'])->name('review-list');
    Route::get('admin-dashboard/review-request',[ReviewsController::class,'reviewsrequest'])->name('review-request');
    Route::get('admin-dashboard/review-status/{id}',[ReviewsController::class,'reviewsStatus']);
    // Route::post('admin-dashboard/update-review-status',[ReviewsController::class,'updateapproved']);
    Route::post('admin-dashboard/update-review-status',[ReviewsController::class,'updatestatus']);
    Route::get('admin-dashboard/review/delete/{id}',[ReviewsController::class,'delete']);

    /////////////////////////////////////CONFIGURATION SETTING Site Content Routes ::::::::::::::::::::::::::::::::::::::::::::::::

    Route::get('/admin-dashboard/configuration/add-about-content',[SiteContentController::class,'aboutContent'])->name('about-meta');
    Route::post('/admin-dashboard/about-page-content/addprocess',[SiteContentController::class,'aboutAddProcess']);

    Route::post('admin-dashboard/site-content/support/submit',[SiteContentController::class,'supportContentSubmit']);

    Route::post('/addHomeContent',[SiteContentController::class,'homeContent'])->name('addHomeContent');
  
    // Site configuration page :::
    Route::get('/admin-dashboard/configuration/site-setting',[SiteContentController::class,'siteConfiguration'])->name('site-setting');
    Route::get('/admin-dashboard/configuration/home-page-setting',[SiteContentController::class,'homeConfigurationContent'])->name('home-setting');
    Route::post('/admin-dashboard/update-site-setting',[SiteContentController::class,'updateSiteConfiguration']);
    Route::post('/update-image',[SiteContentController::class,'updateImage']);

    //// about page configuration 

    Route::post('/admin-dashboard/about-page-update',[SiteContentController::class,'aboutPageupdate']);
    Route::post('/admin-dashboard/update-site-content',[SiteContentController::class,'updateHomeConfiguration']);

    Route::post('/admin-dashboard/reviews-page-submit',[SiteContentController::class,'reviewsSubmit']);
    Route::post('/admin-dashboard/login-page-submit',[SiteContentController::class,'loginSubmit']);
    Route::post('/admin-dashboard/register-page-submit',[SiteContentController::class,'registerSubmit']);
    Route::post('/admin-dashboard/blogs-page-submit',[SiteContentController::class,'blogsSubmit']);
    Route::post('/admin-dashboard/shop-page-submit',[SiteContentController::class,'shopSubmit']);
   
    Route::get('/admin-dashboard/configuration/support-page-setting',[SiteContentController::class,'supportContent'])->name('support-setting');
    Route::get('/admin-dashboard/configuration/about-page-setting',[SiteContentController::class,'aboutPageSetting'])->name('about-setting');
    Route::get('/admin-dashboard/configuration/login-page-setting',[SiteContentController::class,'login'])->name('login-setting');
    Route::get('/admin-dashboard/configuration/register-page-setting',[SiteContentController::class,'register'])->name('register-setting');
    Route::get('/admin-dashboard/configuration/blogs-page-setting',[SiteContentController::class,'blogs'])->name('blogs-setting');
    Route::get('/admin-dashboard/configuration/reviews-page-setting',[SiteContentController::class,'reviews'])->name('reviews-setting');
    Route::get('/admin-dashboard/configuration/shop-page-setting',[SiteContentController::class,'shop'])->name('shop-setting');
    Route::get('/admin-dashboard/configuration/site-text-setting',[SiteContentController::class,'siteText'])->name('site_text.setting');
    Route::post('/admin-dashboard/configuration/site-text-update',[SiteContentController::class,'siteTextUpdate'])->name('site_text.update');
    Route::get('admin-dashboard/configuration/terms-conditions/{id?}',[SiteContentController::class,'termsConditionsContent']);
    Route::post('admin-dashboard/configuration/terms-conditions/submitProcc',[SiteContentController::class,'termsConditionsProcc']);
    Route::get('admin-dashboard/configuration/deleteTerms/{id}',[SiteContentController::class,'deleteTerms']);

    //// DISCOUNT ROUTES /////
    
    Route::get('/admin-dashboard/add-discount/{id?}',[AdminDiscountController::class,'index'])->name('admin.discount.add');
    Route::get('/admin-dashboard/discount-list',[AdminDiscountController::class,'discountList'])->name('admin.discount.list');
    Route::post('/admin-dashboard/discount/addProcc',[AdminDiscountController::class,'addProcc']);
    Route::get('admin-dashboard/discount/delete/{id}',[AdminDiscountController::class,'delete']);
});
/////////////////////////// ADMIN ROUTES END ///////////////////////////////

/////////////////////////// DESIGNER ROUTES ////////////////////////////////

/** All Designer dashbord data */
Route::group(['middleware'=>['auth','Designer']],function(){
    Route::get('/logo-designer-dashboard',[DesignerDashController::class,'index'])->name('designer-dashboard');
    Route::get('/logo-designer-dashboard/setting',[AccountSetting::class,'index'])->name('account-setting');
    Route::get('/logo-designer-dashboard/change-password',[AccountSetting::class,'changePassword']);
    Route::post('/designer-dashboard/change-password-procc',[AccountSetting::class,'changePasswordProcc']);
    
    Route::post('/designer-dashboard/setting/submitProc',[AccountSetting::class,'update']);

    Route::get('logo-designer-dashboard/mylogos',[DesginerLogoController::class,'index'])->name('my-logos');
    Route::get('logo-designer-dashboard/pending-logos',[DesginerLogoController::class,'pendingLogos'])->name('pending-logos');
    Route::get('logo-designer-dashboard/rejected-logos',[DesginerLogoController::class,'rejectedLogos'])->name('rejected-logos');
    Route::get('logo-designer-dashboard/approved-logos',[DesginerLogoController::class,'approvedLogos'])->name('approved-logos');
    Route::get('logo-designer-dashboard/sold-logos',[DesginerLogoController::class,'soldLogos'])->name('sold-logos');
    Route::get('logo-designer-dashboard/uploadlogo/{id?}',[DesginerLogoController::class,'upload'])->name('upload-logo');
    Route::post('designer-dashboard/uploadprocc',[DesginerLogoController::class,'uploadProc']);

    Route::post('designer-dashboard/addtag',[DesginerLogoController::class,'addtag']);
    Route::post('designer-dashboard/deleteimage',[DesginerLogoController::class,'deleteimage']);
    Route::post('designer-dashboard/getStatics',[DesignerDashController::class,'getStatics']);
    Route::get('desinger-dashboard/deleteLogo/{id}',[DesginerLogoController::class,'deleteLogo']);

});

/////////////////////////// DESIGNER ROUTES END ////////////////////////////////
Route::group(['middleware'=>['auth','SpecialDesigner']],function(){
/////////////////////////// SPECIAL DESIGNER ROUTES  ///////////////////////////
Route::get('internal-designer/dashboard/',[SpecialDesignerDashboardController::class,'index']);
Route::get('internal-designer/task-list',[TaskController::class,'taskList']);
Route::get('internal-designer/task-detail/{task_id}',[TaskController::class,'taskDetail']);

// Complete task of special designer
Route::get('internal-designer/complete-task',[TaskController::class,'completeTask']);

// Waiting for reply
Route::get('internal-designer/waiting-for-reply',[TaskController::class,'waitingForReply']);




Route::post('special-designer/upload-process',[TaskController::class,'uploadProc']);
Route::post('special-designer/upload-icon',[TaskController::class,'uploadIcon']);

Route::post('special-designer/delete-image',[TaskController::class,'deleteimage']);
Route::get('send-denied-request',[TaskController::class,'sendTaskDeniedEmail']);  
Route::get('special-designer/download/{media_id}',[TaskController::class,'downloadLogo']);

// Route::post('/store', [TaskController::class,'store'])->name('store');
// Route::post('uploads', [TaskController::class,'uploads'])->name('uploads');
Route::get('internal-designer/messages/{id?}',[SpecialDesginerMessageController::class,'index']);
Route::post('special-designer/messagesProcc',[SpecialDesginerMessageController::class,'messageProcc']);
Route::post('special-designer/seenMessage',[SpecialDesginerMessageController::class,'seenMessage']);
Route::get('internal-designer/download-file/{file_name}',[SpecialDesginerMessageController::class,'download_file']);  // before it was download-file
Route::post('special-designer/deleteMessage',[SpecialDesginerMessageController::class,'delete']);
Route::post('special-designer/updateMessage',[SpecialDesginerMessageController::class,'updateMessage']);

// Account setting Route
Route::get('internal-designer/account-setting',[SpecialDesignerDashboardController::class,'accountSetting']);
Route::post('special-designer/change-password',[SpecialDesignerDashboardController::class,'changePassword']);


});

/////////////////////////// SPECIAL DESIGNER END  ///////////////////////////

/**  ::::::::::::::::: Basic Routes :::::::::::::::  */
Route::get('/logout', [AuthenticationController::class, 'logout']);

Route::get('test-check',[TestController::class,'index']);
Route::get('/mail', function () {
    return view('Mail.register_confirmation.index');
});

Route::get('read-notification/{notification_id}',[BasicController::class,'readNotification']);
Route::get('download-file/{media_id}',[BasicController::class,'downloadFile']);
Route::post('add-to-wishlist',[BasicController::class,'addToWishlist']);

//////////////////////////////////////////////////////////////////////////////////
Route::group(['middleware'=>['EnsureUser','SetLocale']],function(){
    Route::post('logo-checkout',[CheckoutController::class,'checkoutProcess']);
    Route::post('logos/logo-filter',[FrontLogoController::class,'logoFilter'])->name('filter-search');
    Route::get('blog-search',[BlogController::class,'blogsearch']);
    Route::post('reviewSubmit',[MetaPagesController::class,'reviewSubmit']);
    Route::post('/login-process', [AuthenticationController::class, 'loginProcess'])->name('login.process.post');
    Route::post('/send-recovery-email', [AuthenticationController::class,'sendRecoveryEmail']);
    Route::post('/change-pass', [AuthenticationController::class,'changePassProcess']);
    Route::post('desgingerRegisterprocc',[AuthenticationController::class,'designerRegisterProcc']);
    Route::post('/register-process',[AuthenticationController::class,'registerProcess']);


    Route::group(['middleware'=>['auth','UserLogin']],function(){
        Route::post('user-dashboard/updateUserBillingAddress',[UserDashboardController::class,'updateUserBillingAddress']);
        Route::post('user-dashboard/updatePersonalInfo',[UserDashboardController::class,'updatePersonalInfo']);
        Route::post('user-dashboard/changePassword',[UserDashboardController::class, 'changePassword']);
        Route::post('user-dashboard/reviewSubmit',[UserDashboardController::class, 'reviewSubmit']);
        Route::post('user-dahsboard/removeWhislist',[UserDashboardController::class,'removeWhislist']);
        Route::post('user-dashboard/updateUserConfiguration',[UserDashboardController::class,'updateUserConfiguration']);
        Route::post('user-dahsboard/updateStatus/',[UserDashboardController::class,'cancelSubscription']);
        Route::post('user-dashboard/messagesProcc',[UserMessageController::class,'sendMessage']);
        Route::post('user-dashboard/directmessagesProcc',[UserMessageController::class,'sendMessageDirect']);
        Route::post('user-dashboard/seenMessage',[UserMessageController::class,'seenMessage']);
        Route::post('user-dashboard/removeMessage',[UserMessageController::class,'delete']);
        Route::post('user-dashboard/updateMessage',[UserMessageController::class,'updateMessage']);
        Route::post('user-dashboard/updateSubscriptionPaymentMethod',[PaymentController::class,'updateSubscriptionPaymentMethod']);

    });
});
///////////////////////// Route with Prefix //////////////////////////////////////
Route::group(['prefix' => '{locale?}','middleware'=>['EnsureUser','SetLocale','AddLocaleAutomatically']],function(){
    //:::::::::::::::::::::  Basic Controller ::::::::::::::::::::::::: 
    Route::get('/',[HomeController::class,'index'])->name('/');
    Route::get('/about-us',[MetaPagesController::class,'aboutUs'])->name('about-us');
    Route::get('/reviews',[MetaPagesController::class,'reviews'])->name('reviews');
    Route::get('/support',[MetaPagesController::class,'support'])->name('support');
    Route::get('/faq',[MetaPagesController::class,'faq'])->name('faq');
    Route::get('/affiliate',[MetaPagesController::class,'affiliatePage'])->name('affiliate');

    Route::get('/blogs',[BlogController::class,'index'])->name('blogs');
    Route::get('/blogs-details/{slug}',[BlogController::class,'blogDetail']);
    Route::get('/logos/{slug}',[FrontLogoController::class,'index']);
    Route::get('/logo/{slug}',[FrontLogoController::class,'logodetail']);

    Route::get('/logos/checkout/{slug}',[CheckoutController::class,'checkoutView']);
    // Route::post('logo-checkout',[CheckoutController::class,'checkoutProcess']); /////////////////////

    ////////////  Pay with paypal  /////////////////////////
    // Route::get('/pay-with-paypal',[CheckoutController::class,'payWithPaypal']);
    Route::get('handle-payment',[CheckoutController::class,'handlePayment'])->name('make.payment');
    Route::get('cancel-payment',[CheckoutController::class,'paymentCancel'])->name('cancel.payment');
    Route::get('payment-success',[CheckoutController::class,'paymentSuccess'])->name('success.payment');

    ///////////////////////////////////////////////////////////////////////////
    Route::post('/change-format',[CheckoutController::class,'change_currency_format']);
    Route::get('logo-download/{slug}',[FrontLogoController::class,'download_page']);

    // Route::post('logos/logo-filter',[FrontLogoController::class,'logoFilter'])->name('filter-search'); ////////////

    // Route::post('blog-search',[BlogController::class,'blogsearch']); /////////////////

    // Route::post('reviewSubmit',[MetaPagesController::class,'reviewSubmit']); ///////////////
    /* term and conditions: */
  
    /** Authentications */
    // Route::get('/login', [AuthenticationController::class,'login'])->name('login');
    Route::get('/login', [AuthenticationController::class,'loginNew']);
    // Route::post('/login-process', [AuthenticationController::class, 'loginProcess'])->name('login.process.post'); //////////////
    // Route::post('/login-test', [AuthenticationController::class, 'loginTest'])->name('login.test.post');
    Route::get('/register', [AuthenticationController::class,'registerNew']);
    Route::get('/account-recovery', [AuthenticationController::class,'forgotPassword']);
    // Route::post('/send-recovery-email', [AuthenticationController::class,'sendRecoveryEmail']); ///////////////////
    Route::get('/recover-your-pass/{token}', [AuthenticationController::class,'recoverYourPass']);
    // Route::post('/change-pass', [AuthenticationController::class,'changePassProcess']);/////////////////

    Route::get('designer-register',[AuthenticationController::class,'desginerRegister']);
    // Route::post('desgingerRegisterprocc',[AuthenticationController::class,'designerRegisterProcc']); //////////////

    Route::get('/admin-login', function () {
        return view('authentication.admin_login');
    });

    Route::get('/login-old', [AuthenticationController::class,'login'])->name('login');

    //googlelogin
    Route::get('authorized/google',[GoogleController::class,'redirecttogoogle']);
    Route::get('authorized/google/callback',[GoogleController::class,'handleGoogleCallback']);

    Route::get('authorized/facebook',[GoogleController::class,'redirecttofacebook']);
    Route::get('authorized/facebook/callback',[GoogleController::class,'handleFacebookCallback']);

    Route::get('/register-old', [AuthenticationController::class,'register']);
    // Route::post('/register-process',[AuthenticationController::class,'registerProcess']); ////////////////
    Route::get('/register-verify/{token}', [AuthenticationController::class,'registerVerify']);

    Route::get('legal/{pages}', [MetaPagesController::class,'termsAndConditions']);
    Route::get('user-dashboard/logo/download/{order_id}',[UserDashboardController::class,'downloadLogoProcc']);


    ///////////////////////// Simple user Dashboard Routes /////////////////////////////////
    Route::group(['middleware'=>['auth','UserLogin']],function(){
    
        Route::get('/user-dashboard',[UserDashboardController::class, 'UserDashboardIndex'])->name('user-dashboard');
        Route::get('user-dashboard/favourites',[UserDashboardController::class, 'UserFavouritelist'])->name('user-favourites');
        Route::get('user-dashboard/logo',[UserDashboardController::class, 'UserLogoslist'])->name('user-orders');
        Route::get('user-dashboard/configuration',[UserDashboardController::class, 'UserConfiguration'])->name('user-configurations');
        Route::get('user-dashboard/subscriptions',[UserDashboardController::class, 'UserSubscription'])->name('user-subscriptions');
        Route::get('payments/{payment_type}/{slug}',[PaymentController::class,'payment_page']);
        Route::post('purchase-revision-process',[PaymentController::class,'extraRevisionPayment']);

        Route::get('payments/response/',[PaymentController::class,'paymentResponesView']);
        
        
        
        // Route::post('user-dashboard/changePassword',[UserDashboardController::class, 'changePassword']); ////////////////////
        // Route::post('user-dashboard/reviewSubmit',[UserDashboardController::class, 'reviewSubmit']);////////////////////
        // Route::post('user-dahsboard/removeWhislist',[UserDashboardController::class,'removeWhislist']);////////////////////
 
        ///// User Dashboard route :::::::
        Route::get('/user-orders', [UserDashboardController::class,'userOrders']);
        Route::get('/order-details/{order_num}', [UserDashboardController::class,'orderDetail'])->name('user-order-detail');
        Route::get('/download-logo/{order_num}', [UserDashboardController::class,'downloadLogo'])->name('download-logo');

        Route::get('/revision/{revision_type}', [UserDashboardController::class,'revisionRequestPage'])->name('revision');

        Route::post('/request-for-revision', [UserDashboardController::class,'requestForRevision']);
        Route::post('/check-revision-status', [UserDashboardController::class,'checkRevisionStatus']);
        
        Route::get('/approve-logo/{revision_id}',[UserDashboardController::class,'approveLogo']);
        Route::get('/disapprove-logo/{revision_id}',[UserDashboardController::class,'disapproveLogo']);

        // Download revised logo 
        Route::get('/downloadProcess/{revision_id}',[UserDashboardController::class,'downloadProcess']);
        ////messages
        Route::get('user-dashboard/messages/{id?}',[UserMessageController::class, 'index'])->name('user-messages');
        Route::get('user-dashboard/download/{filename}',[UserMessageController::class,'download_file']);
        Route::get('user-dashboard/image-cropper',[ImageCropperController::class,'index']);
        // Route::post('user-dashboard/messagesProcc',[UserMessageController::class,'sendMessage']); ///////////////////
        // Route::post('user-dashboard/directmessagesProcc',[UserMessageController::class,'sendMessageDirect']);///////////////////
        // Route::post('user-dahsboard/seenMessage',[UserMessageController::class,'seenMessage']);///////////////////
    });
    ////////////////////////////////////////////////////////////////////////////////////////
});