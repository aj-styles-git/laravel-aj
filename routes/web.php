<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VuesyController;
use App\Http\Controllers\API\payments\ApiPaymentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\institutes\InstituteController;
use App\Http\Controllers\students\StudentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [App\Http\Controllers\VuesyController::class, 'login'])->name('home');
Route::get('/login', [App\Http\Controllers\VuesyController::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\VuesyController::class, 'register'])->name('register');
Route::get('/logout', [App\Http\Controllers\VuesyController::class, 'logout'])->name('logout');
Route::get('/forget-password', [App\Http\Controllers\VuesyController::class, 'forgetPassword'])->name('forget-password');
// Route::resource('users', [UserController::class]);

Auth::routes();

Route::get('{lang}/change-language', [InstituteController::class, 'changeLanguage'])->middleware(['auth:sanctum'])->name('change_language');
Route::post('change-page-language', [InstituteController::class, 'changePageLanguage'])->middleware(['auth:sanctum'])->name('change_page_language');
Route::post('update_layout', [InstituteController::class, 'updateLayout'])->middleware(['auth:sanctum'])->name('update_layout');


Route::group(['middleware' => 'auth'], function () {


    Route::prefix(LaravelLocalization::setLocale())->group(function () {

        Route::get('institutes', [InstituteController::class, 'index'])->name('all_institutes');
        Route::get('add-institute', [InstituteController::class, 'addInstitute'])->name('add_institute');
        Route::get('institute/edit/{id}', [InstituteController::class, 'editInstitute'])->name('edit_institute');
        Route::get('institute-profile/{id}', [InstituteController::class, 'instituteProfile'])->name('profile_institute');
        Route::post('/institutes/{id}/upload-document', [InstituteController::class, 'uploadDocument'])->name('institute.uploadDocument');
        Route::put('/institutes/{id}/toggle-status', [InstituteController::class, 'toggleStatus'])->name('institute.toggleStatus');
        Route::get('/institutes/{id}/document', [InstituteController::class, 'showDocument'])->name('institute.document');

        Route::get('students', [InstituteController::class, 'allStudents'])->name('all_students');
        Route::get('students/edit/{student_id}', [InstituteController::class, 'editProfile'])->name('student_edit');
        Route::get('students/student-profile/{student_id}', [InstituteController::class, 'studentProfile'])->name('student_profile');
        Route::get('add-student', [InstituteController::class, 'addStudent'])->name('add_student');

        Route::get('courses', [InstituteController::class, 'allCourses'])->name('all_courses');
        Route::get('add-course', [InstituteController::class, 'addCourse'])->name('add_course');
        Route::get('all_categories', [InstituteController::class, 'allcategories'])->name('all_categories');
        Route::get('course/detail/{course_id}', [InstituteController::class, 'courseDetail'])->name('course_detail');
        Route::get('course/edit/{id}', [InstituteController::class, 'editCourse'])->name('edit_course');


        Route::get('transections', [InstituteController::class, 'allTransections'])->name('all_transections');
        Route::get('approvals', [InstituteController::class, 'allApprovals'])->name('all_approvals');
        
        Route::get('coupons', [InstituteController::class, 'allCoupons'])->name('all_coupons');
        Route::get('add-coupon', [InstituteController::class, 'addCoupon'])->name('add_coupon');
        Route::get('coupons/edit/{id}', [InstituteController::class, 'editCoupon'])->name('coupon_edit');

        Route::get('dashboard', [InstituteController::class, 'dashboard'])->name('dashboard');

        // App Settings 
        Route::get('commissions', [InstituteController::class, 'commissions'])->name('commissions');
        Route::get('admins', [InstituteController::class, 'admins'])->name('admins');
        Route::get('personal_info', [InstituteController::class, 'personalInfo'])->name('personal_info');
        Route::get('api-keys', [InstituteController::class, 'apikeys'])->name('api_keys');
        Route::get('notify', [InstituteController::class, 'notify'])->name('notify');
        Route::get('email', [InstituteController::class, 'email'])->name('email');


    });


    Route::get('tables-advanced', [VuesyController::class, 'tablesAdvanced'])->name('tablesAdvanced');
    Route::get('form-elements', [VuesyController::class, 'formElements'])->name('formElements');
    Route::get('invoices-list', [VuesyController::class, 'invoiceslist'])->name('invoices-list');
    Route::get('icons-boxicons', [VuesyController::class, 'iconsboxicons'])->name('icons-boxicons');
    Route::get('auth-resetpassword-cover', [VuesyController::class, 'authresetpasswordcover'])->name('auth-resetpassword-cover');
    Route::get('auth-forgotpassword-cover', [VuesyController::class, 'authforgotpasswordcover'])->name('auth-forgotpassword-cover');
    Route::get('error-404-cover', [VuesyController::class, 'error404cover'])->name('error-404-cover');
    Route::get('form-advanced', [VuesyController::class, 'formAdvanced'])->name('formAdvanced');
    Route::get('pricing-basic', [VuesyController::class, 'pricingbasic'])->name('pricing-basic');
    Route::get('form-wizard', [VuesyController::class, 'formWizard'])->name('formWizard');
    Route::get('layout-vertical', [VuesyController::class, 'layoutVertical'])->name('layoutVertical');
    Route::get('ecommerce-orders', [VuesyController::class, 'ecommerceorders'])->name('ecommerce-orders');
    Route::get('ecommerce-cart', [VuesyController::class, 'ecommercecart'])->name('ecommerce-cart');
    Route::get('extended-lightbox', [VuesyController::class, 'extendedlightbox'])->name('extended-lightbox');
    Route::get('ui-cards', [VuesyController::class, 'uicards'])->name('ui-cards');
    Route::get('ui-modals', [VuesyController::class, 'uimodals'])->name('ui-modals');
    Route::get('ui-buttons', [VuesyController::class, 'uiButtons'])->name('uiButtons');
    Route::get('maps-google', [VuesyController::class, 'mapsGoogle'])->name('mapsGoogle');
    Route::get('extended-sweet-alert', [VuesyController::class, 'extendedSweetAlert'])->name('extended-sweet-alert');
    Route::get('form-validation', [VuesyController::class, 'formvalidation'])->name('form-validation');
    Route::get('invoices-detail', [VuesyController::class, 'invoicesdetail'])->name('invoices-detail');
    Route::get('auth-forgotpassword-basic', [VuesyController::class, 'authforgotpasswordbasic'])->name('auth-forgotpassword-basic');
    Route::get('contacts-list', [VuesyController::class, 'contactslist'])->name('contacts-list');
    Route::get('pricing-table', [VuesyController::class, 'pricingtable'])->name('pricing-table');
    Route::get('charts-line', [VuesyController::class, 'chartsline'])->name('charts-line');
    Route::get('ui-utilities', [VuesyController::class, 'uiutilities'])->name('ui-utilities');
    Route::get('icons-materialdesign', [VuesyController::class, 'iconsmaterialdesign'])->name('icons-materialdesign');
    Route::get('ecommerce-product-detail', [VuesyController::class, 'ecommerceproductdetail'])->name('ecommerce-product-detail');
    Route::get('icons-unicons', [VuesyController::class, 'iconsunicons'])->name('icons-unicons');
    Route::get('pages-profile', [VuesyController::class, 'pagesprofile'])->name('pages-profile');
    Route::get('contacts-settings', [VuesyController::class, 'contactssettings'])->name('contacts-settings');
    Route::get('icons-fontawesome', [VuesyController::class, 'iconsfontawesome'])->name('icons-fontawesome');
    Route::get('apps-kanban-board', [VuesyController::class, 'appskanbanboard'])->name('apps-kanban-board');
    Route::get('contacts-grid', [VuesyController::class, 'contactsgrid'])->name('contacts-grid');
    Route::get('users', [UserController::class, 'index'])->name('users-index');
    Route::get('delete-users/{id}', [UserController::class, 'destroy'])->name('delete-user');
    Route::get('users-edit/{id}', [UserController::class, 'edit'])->name('users-edit');
    Route::post('users-update/{id}', [UserController::class, 'update'])->name('user-update');

    Route::get('roles', [RoleController::class, 'index'])->name('show-roles');
    Route::get('roles-create', [RoleController::class, 'create'])->name('create-roles');
    Route::post('store-roles', [RoleController::class, 'store'])->name('store-roles');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
});


Route::get('/test', [ApiPaymentController::class, 'paymentTest']);
