<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/register' ,[UserController::class, 'register'])->name('register');
Route::get('/forgot-password' ,[UserController::class, 'forgot'])->name('forgot-password');
Route::get('/reset-password/{email}/{token}' ,[UserController::class, 'resetPassword'])->name('reset');
Route::post('/reset-password' ,[UserController::class, 'updatePassword'])->name('update.password');

Route::post('/register' ,[UserController::class, 'registerUser'])->name('register');
Route::post('/login' ,[UserController::class, 'loginUser'])->name('auth.login');

Route::post('/forgot-password' ,[UserController::class, 'forgotPassword'])->name('auth.forgot-password');



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

