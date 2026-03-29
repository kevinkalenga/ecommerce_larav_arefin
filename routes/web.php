<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;


use App\Http\Controllers\User\UserController;




use App\Http\Controllers\Front\FrontController;



Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/faq', [FrontController::class, 'faq'])->name('faq');
Route::get('/terms', [FrontController::class, 'terms'])->name('terms');
Route::get('/privacy', [FrontController::class, 'privacy'])->name('privacy');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/post/{slug}', [FrontController::class, 'post'])->name('post');
Route::get('/products', [FrontController::class, 'products'])->name('products');
Route::get('/product/{slug}', [FrontController::class, 'product'])->name('product');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');


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
   Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
   Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');
   Route::get('/user/index', [AdminUserController::class, 'index'])->name('admin_user_index');
   Route::get('/user/create', [AdminUserController::class, 'create'])->name('admin_user_create');
   Route::post('/user/store', [AdminUserController::class, 'store'])->name('admin_user_store');
   Route::get('/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin_user_edit');
   Route::post('/user/update/{id}', [AdminUserController::class, 'update'])->name('admin_user_update');
   Route::get('/user/delete/{id}', [AdminUserController::class, 'delete'])->name('admin_user_delete');

});


/************************************* User ********************************/

Route::middleware('auth')->prefix('user')->group(function(){ 

   Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user_dashboard');
   Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
   Route::post('/profile-submit', [UserController::class, 'profile_submit'])->name('user_profile_submit');
   Route::get('/orders', [UserController::class, 'orders'])->name('user_orders');
   Route::get('/wishlist', [UserController::class, 'wishlist'])->name('user_wishlist');

});

Route::prefix('user')->group(function(){
  Route::get('/registration', [UserController::class, 'registration'])->name('user_registration');
  Route::post('/registration-submit', [UserController::class, 'registration_submit'])->name('user_registration_submit');
  Route::get('/registration_verify/{email}/{token}', [UserController::class, 'registration_verify'])->name('user_registration_verify');
  Route::get('/login', [UserController::class, 'login'])->name('user_login');
  Route::post('/login-submit', [UserController::class, 'login_submit'])->name('user_login_submit');
  Route::get('/logout', [UserController::class, 'logout'])->name('user_logout');
  Route::get('/forget-password', [UserController::class, 'forget_password'])->name('user_forget_password');
  Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('user_forget_password_submit');
  Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('user_reset_password');
  Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('user_reset_password_submit');
});


