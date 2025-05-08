<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\institutes\ApiInstituteController;
use App\Http\Controllers\API\students\ApiStudentController;
use App\Http\Controllers\API\courses\ApiCourseController;
use App\Http\Controllers\API\wallet\ApiWalletController;
use App\Http\Controllers\API\payments\ApiPaymentController;
use App\Http\Controllers\API\coupons\ApiCouponController;
use App\Http\Controllers\API\location\ApiLocationController;
use App\Http\Controllers\API\app_settings\ApiAppSettings;
use App\Http\Controllers\API\app_settings\ApiPushNotificationController;
use App\Http\Controllers\API\app_settings\ApiMailController;
use App\Http\Controllers\API\dashboard\ApiDashboardController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




// INSTITUTES ROUTE
Route::post('institutes/login',[ApiInstituteController::class,"login"]);
Route::get('institutes/search',[ApiInstituteController::class,"search"]);
Route::post('institutes/forget-password',[ApiInstituteController::class,"forgetPassword"]);
Route::get('institutes/{institute_id}/courses',[ApiInstituteController::class,"getInstituteAllCourses"]);
Route::get('institutes/{institute_id}/coupons',[ApiInstituteController::class,"getInstituteAllCoupons"]);
Route::get('institutes/{institute_id}/ratings',[ApiInstituteController::class,"getInstituteRating"]);
Route::post('institutes/{institute_id}/ratings',[ApiInstituteController::class,"postInstituteRating"]);
Route::get('institutes/{institute_id}/wallet-transactions',[ApiInstituteController::class,"getWalletMetaData"]);
Route::get('institutes/{institute_id}/withdraw-requests',[ApiInstituteController::class,"getWithdrawRequests"]);
Route::post('institutes/{institute_id}/withdraw-requests',[ApiInstituteController::class,"WithdrawRequests"]);
Route::get('institutes/{institute_id}/download-statement',[ApiInstituteController::class,"downloadStatement"]);
Route::resource('institutes',ApiInstituteController::class);
Route::put('/institutes/{id}/toggle-status', [ApiInstituteController::class, 'toggleStatus'])->name('institute.toggleStatus');
// Route::resource('institutes',ApiInstituteController::class)->middleware(['auth:sanctum']);

// Student Routes 
Route::post('students/login',[ApiStudentController::class,"login"]);
Route::get('students/search',[ApiStudentController::class,"search"]);
Route::get('students/{student_id}/orders',[ApiStudentController::class,"getStudentOrders"]);
Route::post('students/courses/search',[ApiStudentController::class,"courseSearch"]);
Route::post('students/attendance/export',[ApiStudentController::class,"exportAttendance"]);
Route::get('students/{student_id}/courses',[ApiStudentController::class,"getStudentAllCourses"]);
Route::get('students/{student_id}/enrollement/{course_id}',[ApiStudentController::class,"enrollStudentInCourse"]);
Route::resource('students',ApiStudentController::class);


// COURSES ROUTE 
Route::get('courses/search',[ApiCourseController::class,"search"]);
Route::get('courses/categories',[ApiCourseController::class,"getAllCategories"]);
Route::get('courses/{course_id}/students',[ApiCourseController::class,"getAllCourseStudents"]);
Route::get('courses/{course_id}/coupons',[ApiCourseController::class,"getAllCoupons"]);
Route::post('courses/categories',[ApiCourseController::class,"addCategory"]);
Route::post('courses/categories/{id}',[ApiCourseController::class,"updateCategory"]);
Route::get('courses/categories/{id}',[ApiCourseController::class,"getCategory"]);
Route::resource('courses',ApiCourseController::class)->middleware(['auth:sanctum']);


// Wallet 
Route::resource('wallets',ApiWalletController::class)->middleware(['auth:sanctum']);


// Payments 
Route::post('payments/institutes/make-approval-request',[ApiPaymentController::class,'approvalRequest'])->middleware(['auth:sanctum']);
Route::get('payments/institutes/withdraw-requests',[ApiPaymentController::class,'getAllPendingApprovals'])->middleware(['auth:sanctum']);
Route::post('payments/institutes/withdraw-requests',[ApiPaymentController::class,'changeApprovalStatus'])->middleware(['auth:sanctum']);
Route::post('payments/iniciate-payment',[ApiPaymentController::class,'iniciatePayment']);

Route::get('download-invoice/{id}',[ApiPaymentController::class,'downloadInvoice'])->middleware(['auth:sanctum']);
Route::get('institute-orders/{id}',[ApiPaymentController::class,'getInstituteOrders'])->middleware(['auth:sanctum']);
Route::resource('orders',ApiPaymentController::class)->middleware(['auth:sanctum']);


// Coupons 
Route::get('coupons/top-coupons',[ApiCouponController::class,"getTopCoupons"])->middleware(['auth:sanctum']);
Route::post('coupons/verify',[ApiCouponController::class,"verifyCoupon"])->middleware(['auth:sanctum']);
Route::get('coupons/institute/{institute_id}',[ApiCouponController::class,"getInstituteAllCoupons"])->middleware(['auth:sanctum']);
Route::resource('coupons',ApiCouponController::class)->middleware(['auth:sanctum']);


// Location 
Route::post('countries',[ApiLocationController::class,"getCountries"]);
Route::post('states',[ApiLocationController::class,"getStates"]);
Route::post('cities',[ApiLocationController::class,"getCities"]);


// App Settings 
Route::post('appsettings/reasons',[ApiAppSettings::class,"getReasons"])->middleware(['auth:sanctum']);
Route::post('settings/update',[ApiAppSettings::class,"updateSettings"])->middleware(['auth:sanctum']);
Route::post('settings',[ApiAppSettings::class,"getSettings"])->middleware(['auth:sanctum']);


// Push Notifications 

Route::post('send_push_notifications',[ApiPushNotificationController::class,"sendPushNotifications"])->middleware(['auth:sanctum']);
Route::post('push-notifications',[ApiPushNotificationController::class,"getPushNotificaions"])->middleware(['auth:sanctum']);

// Create Admin 
Route::post('appsettings/admin',[ApiAppSettings::class,"createAdmin"])->middleware(['auth:sanctum']);
Route::post('appsettings/admin/{id}',[ApiAppSettings::class,"updateAdmin"])->middleware(['auth:sanctum']);
Route::get('appsettings/admin',[ApiAppSettings::class,"getAdmins"])->middleware(['auth:sanctum']);
Route::get('appsettings/admin/{id}',[ApiAppSettings::class,"getAdmin"])->middleware(['auth:sanctum']);



// Emails 
Route::post('send_welcome_email',[ApiMailController::class,"welcome_mail"])->middleware(['auth:sanctum']);


// Dashboard 
Route::get('dashboard',[ApiDashboardController::class,"dashboard"])->middleware(['auth:sanctum']);
Route::get('institute_dashboard/{id}',[ApiDashboardController::class,"instituteDashboard"])->middleware(['auth:sanctum']);
Route::get('student_dashboard/{id}',[ApiDashboardController::class,"studentDashboard"])->middleware(['auth:sanctum']);

// Auth 
Route::post('forget-password',[ResetPasswordController::class,"forgetPassword"]);


Route::post('social-login',[LoginController::class,"socailLogin"]);


