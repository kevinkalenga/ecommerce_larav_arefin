<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;


use App\Http\Controllers\User\UserController;




use App\Http\Controllers\Front\FrontController;



Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');


/************************************* Admin ********************************/

Route::prefix('admin')->group(function(){ 
   Route::get('/', function() {
     return redirect()->route('admin_login');
   });
   Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
   Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
   Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
   Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
   Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
   Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
   Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

});


Route::prefix('admin')->middleware('admin')->group(function(){ 

   Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');

});


/************************************* User ********************************/

Route::middleware('auth')->group(function(){ 

   Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

});

Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/registration-submit', [UserController::class, 'registration_submit'])->name('registration_submit');
Route::get('/registration_verify/{email}/{token}', [UserController::class, 'registration_verify'])->name('registration_verify');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-submit', [UserController::class, 'login_submit'])->name('login_submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('reset_password_submit');


