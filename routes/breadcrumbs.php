<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('ADMIN-DASHBOARD', route('admin-dashboard'));
});
Breadcrumbs::for('logos-request', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('LOGOS-REQUESTS', route('logos-requests'));
});
Breadcrumbs::for('logos-detail', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('logos-request');
    $trail->push('DETAIL PAGE', route('logos-requests',['slug'=>$slug]));
});
Breadcrumbs::for('approved-logos', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('APPROVED LOGOS', route('approved-logos'));
});
Breadcrumbs::for('disapproved-logos', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('DISAPPROVED LOGOS', route('disapproved-logos'));
});
Breadcrumbs::for('sold-logos', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('SOLD LOGOS', route('sold-logos'));
});
Breadcrumbs::for('desingers-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('DESIGNERS LIST', route('designer-list'));
});
Breadcrumbs::for('designer-view', function (BreadcrumbTrail $trail,$name) {
    $trail->parent('desingers-list');
    $trail->push($name, route('designer-view',['id'=>$name]));
});
Breadcrumbs::for('guests-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('GUESTS-LIST', route('guest-list'));
});
Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('CATEGORIES', route('categories'));
});
Breadcrumbs::for('categories-add', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push('ADD', route('add-categories'));
});
Breadcrumbs::for('tags', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('TAGS', route('tags'));
});

Breadcrumbs::for('blog-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('BLOGS-LIST', route('blogs-list'));
});
Breadcrumbs::for('blog-add', function (BreadcrumbTrail $trail) {
    $trail->parent('blog-list');
    $trail->push('ADD', route('add-blogs'));
});
Breadcrumbs::for('blog-update', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('blog-list');
    $trail->push('UPDATE', route('edit-blogs',['slug'=>$slug]));
});
Breadcrumbs::for('blog-category', function (BreadcrumbTrail $trail) {
    $trail->parent('blog-list');
    $trail->push('CATEGORIES', route('blog-category'));
});
Breadcrumbs::for('styles', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('STYLES', route('styles'));
});
Breadcrumbs::for('branches', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('BRANCHES', route('branches'));
});
Breadcrumbs::for('special-desingers', function(BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('INTERNAL-DESINGER-LIST', route('special-desinger-list'));
});
Breadcrumbs::for('add-special-desinger', function(BreadcrumbTrail $trail) {
    $trail->parent('special-desingers');
    $trail->push('ADD', route('add-special-desinger'));
});
Breadcrumbs::for('facilities', function(BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('LOGO-FACILITIES',route('logo-facilities'));
});
Breadcrumbs::for('additional-options', function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('LOGO-ADDITIONAL-OPTION',route('additional-options'));
});
Breadcrumbs::for('support-setting', function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('SUPPORT-PAGE-CONTENT',route('support-setting'));
});
Breadcrumbs::for('site-setting', function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('SITE-CONTENT',route('site-setting'));
});
Breadcrumbs::for('about-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('ABOUT-PAGE-CONTENT',route('about-setting'));
});
Breadcrumbs::for('login-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('LOGIN-PAGE-CONTENT',route('login-setting'));
});
Breadcrumbs::for('register-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('REGISTER-PAGE-CONTENT',route('register-setting'));
});
Breadcrumbs::for('blogs-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('BLOGS-PAGE-CONTENT',route('blogs-setting'));
});
Breadcrumbs::for('reviews-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('REVIEWS-PAGE-CONTENT',route('reviews-setting'));
});
Breadcrumbs::for('shop-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('SHOP-PAGE-CONTENT',route('shop-setting'));
});
Breadcrumbs::for('home-setting',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('HOME-PAGE-CONTENT',route('home-setting'));
});
Breadcrumbs::for('reviews',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('REVIEWS',route('review-list'));
});
Breadcrumbs::for('review-request',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('REVIEWS-REQUESTS',route('review-request'));
});
Breadcrumbs::for('update-review',function(BreadcrumbTrail $trail){
    $trail->parent('reviews');
    $trail->push('UPDATES',route('update-review',['id'=>1]));
});
Breadcrumbs::for('revision-request',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('LOGOS REVISION REQUESTS',route('revision-request'));
});
Breadcrumbs::for('revision-request-detail',function(BreadcrumbTrail $trail){
    $trail->parent('revision-request');
    $trail->push('DETAIL',route('revision-request-detail',['request_id'=>1]));
});
Breadcrumbs::for('on-revision',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('ON REVISION',route('on-revision'));
});
Breadcrumbs::for('on-revision-detail',function(BreadcrumbTrail $trail){
    $trail->parent('on-revision');
    $trail->push('DETAIL',route('on-revision-detail',['revision_id'=>1]));
});
Breadcrumbs::for('revised-logos',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('REVISED LOGOS',route('revised-logos'));
});
Breadcrumbs::for('revised-logos-detail',function(BreadcrumbTrail $trail){
    $trail->parent('revised-logos');
    $trail->push('DETAIL',route('revised-logos-detail',['revision_id'=>1]));
});
Breadcrumbs::for('discount-list',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('DISCOUNTS',route('admin.discount.list'));
});
Breadcrumbs::for('discount-add',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('DISCOUNTS ADD',route('admin.discount.add',['id'=>1]));
});
Breadcrumbs::for('site-meta',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('SITE META',route('site-meta'));
});
Breadcrumbs::for('site-meta-update',function(BreadcrumbTrail $trail,$site_key){
    $trail->parent('site-meta');
    $trail->push($site_key,route('site-meta-update',['id'=>$site_key]));
});
Breadcrumbs::for('support-meta',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('SUPPORT PAGE META',route('support-meta',['id'=>1]));
});
Breadcrumbs::for('about-meta',function(BreadcrumbTrail $trail){
    $trail->parent('admin-dashboard');
    $trail->push('ABOUT PAGE META',route('about-meta',['id'=>1]));
});


/////// Desinger breadcrumbs 
Breadcrumbs::for('designer-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('LOGO-DESIGNER-DASHBOARD', route('designer-dashboard'));
});
Breadcrumbs::for('account-setting', function (BreadcrumbTrail $trail) {
    $trail->parent('designer-dashboard');
    $trail->push('ACCOUNT-SETTINGS', route('account-setting'));
});

Breadcrumbs::for('change-password', function (BreadcrumbTrail $trail) {
    $trail->parent('designer-dashboard');
    $trail->push('CHANGE-PASSWORD', url('/designer-dashboard/change-password'));
});

Breadcrumbs::for('logos', function (BreadcrumbTrail $trail) {
    $trail->parent('designer-dashboard');
    $trail->push('LOGOS', route('my-logos'));
});
Breadcrumbs::for('logos-upload', function (BreadcrumbTrail $trail) {
    $trail->parent('logos');
    $trail->push('UPLOAD', route('upload-logo'));
});


/////user-dashboard
Breadcrumbs::for('user-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('DASHBOARD', url(app()->getlocale().'/user-dashboard'));
});
Breadcrumbs::for('favourites', function (BreadcrumbTrail $trail) {
    $trail->parent('user-dashboard');
    $trail->push('FAVOURITES', url(app()->getlocale().'/user-dashboard/favourites'));
});
Breadcrumbs::for('user-orders', function (BreadcrumbTrail $trail) {
    $trail->parent('user-dashboard');
    $trail->push('MY LOGOS', url(app()->getlocale().'/user-dashboard/logo'));
});
Breadcrumbs::for('configurations', function (BreadcrumbTrail $trail) {
    $trail->parent('user-dashboard');
    $trail->push('CONFIGURATIONS', route('user-configurations'));
});
Breadcrumbs::for('subscriptions', function (BreadcrumbTrail $trail) {
    $trail->parent('user-dashboard');
    $trail->push('SUBSCRIPTIONS', route('user-subscriptions'));
});
Breadcrumbs::for('user-messages', function (BreadcrumbTrail $trail) {
    $trail->parent('user-dashboard');
    $trail->push('MESSAGES', route('user-messages'));
});
Breadcrumbs::for('user-order-detail', function (BreadcrumbTrail $trail,$order_num) {
    $trail->parent('user-orders');
    $trail->push($order_num, route('user-order-detail',['order_num'=>$order_num]));
});
Breadcrumbs::for('download-logo', function (BreadcrumbTrail $trail,$order_num) {
    $trail->parent('user-orders');
    $trail->push($order_num, route('download-logo',['locale'=>app()->getLocale(),'order_num'=>$order_num]));
});

Breadcrumbs::for('revision', function (BreadcrumbTrail $trail,$revision_type,$order_num) {
    $trail->parent('download-logo', $order_num);
    $trail->push('REVISION', route('revision',['revision_type'=>$revision_type,'order_num'=>$order_num]));
});

?>