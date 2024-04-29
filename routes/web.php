<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Students\StudentDashboardController;
use App\Http\Controllers\Login\ForgotController;
use App\Models\User;

Route::get('/',function (){
    return redirect()->route('formlogin');
});


Route::prefix('login')->group(function (){
    Route::get('/',[AuthController::class,'getFormLogin'])->name('formlogin');
    Route::post('/',[AuthController::class,'submitLogin'])->middleware('auth.user')->name('login');
    Route::get('/forgot',[ForgotController::class,'fogortAccount'])->name('forgot');
});

Route::prefix('admin')->group(function (){
    Route::get('/',[AdminDashboardController::class,'adminDashboard'])->name('adminlogin');
});

Route::prefix('students')->group(function (){
    Route::get('/',[StudentDashboardController::class,'studentDashboard'])->name('studentlogin');
});

