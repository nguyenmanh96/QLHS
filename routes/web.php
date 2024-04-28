<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Students\StudentDashboardController;
use App\Http\Controllers\Login\ForgotController;
use App\Models\User;

Route::get('/',function (){
    return redirect()->route('formlogin');
});


Route::prefix('login')->group(function (){
    Route::get('/',[AuthController::class,'getFormLogin'])->name('formlogin');
    Route::post('/',[AuthController::class,'submitLogin'])->name('login');
    Route::get('/forgot',[ForgotController::class,'fogortAccount'])->name('forgot');
});

Route::prefix('admin')->group(function (){
    Route::get('/',[AdminDashboardController::class,'adminDashboard']);
    Route::get('/delete-user',function (){
        $user = \App\Models\User::find(2);
        $user->delete();
        echo 'Da xoa item';
    });
});

Route::prefix('students')->group(function (){
    Route::get('/',[StudentDashboardController::class,'stDashboard']);
});

