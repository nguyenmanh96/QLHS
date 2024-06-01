<?php

use App\Http\Controllers\Student\StSubjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Student\StDepartmentController;
use App\Http\Controllers\Login\ForgotController;
use App\Http\Controllers\Login\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Student\ProfileController;

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
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/get-weather', [DashboardController::class, 'currentWeather']);
    Route::prefix('department')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('admin.department.list');
        Route::post('/add', [DepartmentController::class, 'store'])->name('admin.department.store');
        Route::get('{id}/edit', [DepartmentController::class, 'edit'])->name('admin.department.edit');
        Route::put('update', [DepartmentController::class, 'update'])->name('admin.department.update');
        Route::delete('/delete', [DepartmentController::class, 'destroy'])->name('admin.department.delete');
    });
    Route::prefix('subject')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('admin.subject.list');
        Route::post('/add', [SubjectController::class, 'store'])->name('admin.subject.add');
        Route::get('{id}/edit', [SubjectController::class, 'edit'])->name('admin.subject.edit');
        Route::put('/update', [SubjectController::class, 'update'])->name('admin.subject.update');
        Route::delete('/delete', [SubjectController::class, 'destroy'])->name('admin.subject.delete');
    });
});

Route::prefix('student')->middleware(['auth','auth.user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/get-weather', [ProfileController::class, 'currentWeather'])->name('get-weather');
    Route::post('/', [ProfileController::class, 'update'])->name('change-image');
    Route::prefix('/department')->group(function () {
        Route::get('/', [StDepartmentController::class, 'index'])->name('st.department.list');
    });
    Route::prefix('/subject')->group(function () {
        Route::get('/', [StSubjectController::class, 'index'])->name('st.subject.list');
        Route::post('/', [StSubjectController::class, 'store'])->name('st.subject.register');

    });
});



