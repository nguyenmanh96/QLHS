<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Login\ForgotController;
use App\Http\Controllers\Login\GoogleController;
use App\Http\Controllers\LanguageChangeController;
use App\Http\Controllers\LogoutController;

Route::get('/', function () {
    return redirect()->route('formlogin');
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::prefix('login')->group(function () {
    Route::get('/', [AuthController::class, 'getFormLogin'])->name('formlogin');
    Route::post('/', [AuthController::class, 'submitLogin'])->name('login');
});

Route::get('/forgot', [ForgotController::class, 'getFormForgot'])->name('form-forgot');
Route::post('/forgot', [ForgotController::class, 'sendResetPassword'])->name('send-link');
Route::get('/reset/{token}', [ForgotController::class, 'getFormReset'])->name('form-reset');
Route::post('/reset/{token}', [ForgotController::class, 'resetPassword'])->name('resetPassword');


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin-dashboard');
});

Route::prefix('students')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('student-dashboard');
});



