<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Students\StudentDashboardController;
use App\Http\Controllers\Login\ForgotController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Login
route::prefix('login')->group(function (){
    route::get('/',[LoginController::class,'loginAccount'])->name('login');
    route::get('/forgot',[ForgotController::class,'fogortAccount'])->name('forgot');
});


//Admin
route::prefix('admin')->group(function (){
   //Admin Dashboard
    route::get('/',[AdminDashboardController::class,'adminDashboard']);

});

//Students
route::prefix('students')->group(function (){
   //Students Dashboard
    route::get('/',[StudentDashboardController::class,'stDashboard']);
});



//Route::group([
//    'prefix' => 'qr-code',
//    'as' => 'qr-code.',
//], function () {
//        Route::get('/', [QrCodeController::class, 'index'])
//            ->name('index');
//        Route::get('/download', [QrCodeController::class, 'download'])
//            ->name('download')
//            ->middleware('permission:admin.qr-code.list|admin.qr-code.download');
//        Route::post('/store', [QrCodeController::class, 'store'])->name('store')->middleware('permission:admin.qr-code.store');
//});
