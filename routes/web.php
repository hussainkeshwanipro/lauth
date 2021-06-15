<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//home
Route::get('/', [UserController::class, 'index'])->name('home');  
//login
Route::get('/login', [UserController::class, 'loginPage'])->name('loginPage');
Route::post('postLogin', [UserController::class, 'postLogin'])->name('postLogin');
//register
Route::get('/register', [UserController::class, 'registerPage'])->name('registerPage');
Route::post('postRegister', [UserController::class, 'postRegister'])->name('postRegister');
//userProfile
Route::get('/user', [UserController::class, 'userProfile'])->name('userProfile');
Route::get('/user/edit', [UserController::class, 'userProfileEdit'])->name('userProfileEdit');
Route::post('/user/update', [UserController::class, 'userProfileUpdate'])->name('userProfileUpdate');
//logout
Route::get('/logout', [UserController::class, 'logout'])->name('Userlogout');

//reset password
Route::get('/resetPassword', [UserController::class, 'resetPasswordPage'])->name('resetPasswordPage');
Route::post('postEmail', [UserController::class, 'postEmail'])->name('postEmail');

//confirm password
Route::get('reset/{token}/confirmPassword', [UserController::class, 'confirmPasswordPage']);
Route::post('postConfirmPasswordPage', [UserController::class, 'postConfirmPasswordPage'])->name('postConfirmPasswordPage');

//delete user profile
Route::get('userProfileDelete', [UserController::class, 'userProfileDelete'])->name('userProfileDelete');