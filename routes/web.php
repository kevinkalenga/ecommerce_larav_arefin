<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;




use App\Http\Controllers\FrontController;



Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');


/************************************* Admin ********************************/

Route::prefix('admin')->group(function(){ 

   Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
   Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
   Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
   Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
   Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');

});


Route::prefix('admin')->middleware('admin')->group(function(){ 

   Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');

});


