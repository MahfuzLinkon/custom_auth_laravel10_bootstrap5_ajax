<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/' ,[UserController::class, 'login'])->name('auth.login');
Route::get('/register' ,[UserController::class, 'register'])->name('auth.register');
Route::get('/forgot-password' ,[UserController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::get('/reset-password' ,[UserController::class, 'resetPassword'])->name('auth.reset-password');


