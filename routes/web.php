<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

// all routes

Route::get('/dashboard',[WebsiteController::class,'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('/login',[WebsiteController::class,'login'])->name('login');

Route::post('/login',[WebsiteController::class,'login']);

Route::get('/registration',[WebsiteController::class,'registration'])->name('registration');

Route::get('/registration/verify/{token}/{email}',[WebsiteController::class,'registration_verify']);

Route::post('/registration-submit',[WebsiteController::class,'registration_submit'])->name('registration_submit');

Route::post('/login-submit',[WebsiteController::class,'login_submit'])->name('login_submit');

Route::get('/logout',[WebsiteController::class,'logout'])->name('logout');

Route::get('/forget-password',[WebsiteController::class,'forget_password'])->name('forget_password');

Route::post('/forget-password-submit',[WebsiteController::class,'forget_password_submit'])->name('forget_password_submit');

Route::get('/reset_password/{token}/{email}',[WebsiteController::class,'reset_password'])->name('reset_password');

Route::post('/reset-password-submit',[WebsiteController::class,'reset_password_submit'])->name('reset_password_submit');
