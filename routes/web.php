<?php

use App\Http\Controllers\student\StudentSubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Login\ForgotController;
use App\Http\Controllers\Login\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminSubjectController;
use App\Http\Controllers\Student\StudentDepartmentController;

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


Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/get-weather', [AdminDashboardController::class, 'currentWeather'])->name('get-weather');
    Route::prefix('/department')->group(function () {
        Route::get('/', [AdminDepartmentController::class, 'index'])->name('department-list');
        Route::post('/add', [AdminDepartmentController::class, 'store'])->name('add-department');
        Route::get('{id}/edit', [AdminDepartmentController::class, 'edit'])->name('edit-department');
        Route::put('update', [AdminDepartmentController::class, 'update'])->name('update-department');
        Route::delete('/delete', [AdminDepartmentController::class, 'destroy'])->name('delete-department');
    });
    Route::prefix('subject')->group(function () {
        Route::get('/', [AdminSubjectController::class, 'index'])->name('subject-list');
        Route::post('/add', [AdminSubjectController::class, 'store'])->name('add-subject');
        Route::get('{id}/edit', [AdminSubjectController::class, 'edit'])->name('edit-subject');
        Route::put('/update', [AdminSubjectController::class, 'update'])->name('update-subject');
        Route::delete('/delete', [AdminSubjectController::class, 'destroy'])->name('delete-subject');
    });
});



