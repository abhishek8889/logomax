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
    $trail->push($slug, route('logos-requests',['slug'=>$slug]));
});
Breadcrumbs::for('approved-logos', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('APPROVED-LOGOS', route('approved-logos'));
});
Breadcrumbs::for('disapproved-logos', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('DISAPPROVED-LOGOS', route('disapproved-logos'));
});
Breadcrumbs::for('desingers-list', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-dashboard');
    $trail->push('DESIGNERS-LIST', route('designer-list'));
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


/////// Desinger breadcrumbs 
Breadcrumbs::for('designer-dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('DESIGNER-DASHBOARD', route('designer-dashboard'));
});
Breadcrumbs::for('account-setting', function (BreadcrumbTrail $trail) {
    $trail->parent('designer-dashboard');
    $trail->push('ACCOUNT-SETTING', route('account-setting'));
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



?>