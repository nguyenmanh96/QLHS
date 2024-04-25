<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Students\StudentDashboardController;
use App\Http\Controllers\Login\ForgotController;

Route::get('/',function (){
    return redirect()->route('login');
});
Route::prefix('login')->group(function (){
    Route::get('/',[LoginController::class,'loginAccount'])->name('login');
    Route::get('/forgot',[ForgotController::class,'fogortAccount'])->name('forgot');
});

Route::prefix('admin')->group(function (){
    Route::get('/',[AdminDashboardController::class,'adminDashboard']);
});

Route::prefix('students')->group(function (){
    Route::get('/',[StudentDashboardController::class,'stDashboard']);
});

