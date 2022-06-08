<?php

use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

// all routes

Route::get('/dashboard',[WebsiteController::class,'dashboard'])->name('dashboard');

Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('/login',[WebsiteController::class,'login'])->name('login');

Route::post('/login',[WebsiteController::class,'login']);

Route::get('/registration',[WebsiteController::class,'registration'])->name('registration');

Route::get('/registration/verify/{token}/{email}',[WebsiteController::class,'registration_verify']);

Route::post('/registration-submit',[WebsiteController::class,'registration_submit'])->name('registration_submit');

Route::get('/forget-password',[WebsiteController::class,'forget_password'])->name('forget_password');
