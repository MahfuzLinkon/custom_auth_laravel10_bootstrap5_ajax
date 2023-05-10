<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/' ,[UserController::class, 'index'])->name('login');
Route::get('/register' ,[UserController::class, 'register'])->name('register');
Route::get('/forgot-password' ,[UserController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password' ,[UserController::class, 'resetPassword'])->name('reset-password');
Route::get('/reset-password' ,[UserController::class, 'resetPassword'])->name('reset-password');
Route::post('/register' ,[UserController::class, 'registerUser'])->name('register');
Route::post('/login' ,[UserController::class, 'loginUser'])->name('auth.login');
Route::get('/profile' ,[UserController::class, 'profile'])->name('auth.profile');
Route::get('/logout' ,[UserController::class, 'logout'])->name('auth.logout');

