<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Login\ForgotController;
use App\Http\Controllers\Login\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Admin\DepartmentController;

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


Route::prefix('admin')->middleware(['auth','auth.admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin-dashboard');
    Route::get('/get-time', [AdminDashboardController::class, 'currentTime']);
    Route::get('/get-weather', [AdminDashboardController::class, 'currentWeather']);
    Route::prefix('/department')->group(function () {
        Route::get('/', [DepartmentController::class, 'paginateDepartment']);
        Route::get('/show', [DepartmentController::class, 'departmentList'])->name('department-list');
        Route::post('/add', [DepartmentController::class, 'addDepartment'])->name('add-department');
        Route::get('edit/{id}', [DepartmentController::class, 'editDepartment'])->name('edit-department');
        Route::put('update/{id}', [DepartmentController::class, 'updateDepartment'])->name('update-department');
        Route::delete('/{id}', [DepartmentController::class, 'deleteDepartment'])->name('delete-department');
    });
});

Route::prefix('student')->middleware(['auth'])->middleware('auth.user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('student-dashboard');
});



