<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/register' ,[UserController::class, 'register'])->name('register');
Route::get('/forgot-password' ,[UserController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password' ,[UserController::class, 'resetPassword'])->name('reset-password');
Route::get('/reset-password' ,[UserController::class, 'resetPassword'])->name('reset-password');
Route::post('/register' ,[UserController::class, 'registerUser'])->name('register');
Route::post('/login' ,[UserController::class, 'loginUser'])->name('auth.login');


Route::group(['middleware' => 'LoginCheck'], function (){
    Route::get('/' ,[UserController::class, 'index'])->name('login');
    Route::get('/logout' ,[UserController::class, 'logout'])->name('auth.logout');
    Route::get('/dashboard' ,[UserController::class, 'dashboard'])->name('auth.dashboard');
    // Profile all route
    Route::get('/profile' ,[ProfileController::class, 'profile'])->name('auth.profile');
    Route::get('/profile/edit' ,[ProfileController::class, 'profileEdit'])->name('auth.profile-edit');
    Route::post('/profile/update' ,[ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('/update/profile-image' ,[ProfileController::class, 'profileImageUpdate'])->name('update-profile.image');

});

