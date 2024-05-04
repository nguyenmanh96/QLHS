<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Login\ForgotController;
use App\Http\Controllers\Login\GoogleController;
use App\Http\Controllers\LanguageChangeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('formlogin');
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('/change-lang', [LanguageChangeController::class, 'changeLanguage'])->name('change_language');

Route::prefix('login')->group(function (){
    Route::get('/',[AuthController::class,'getFormLogin'])->name('formlogin');
    Route::post('/',[AuthController::class,'submitLogin'])->middleware('auth.user')->name('login');
});

Route::get('/forgot',[ForgotController::class,'getFormForgot'])->name('form-forgot');
Route::post('/forgot/link',[ForgotController::class,'sendResetPassword'])->name('send-link');
Route::get('/forgot/reset/{token}',[ResetPasswordController::class,'getFormReset'])->name('form-reset');
Route::post('/forgot/reset',[ResetPasswordController::class,'resetPassword'])->name('resetPassword');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin-dashboard');
});

Route::prefix('students')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('student-dashboard');
});



