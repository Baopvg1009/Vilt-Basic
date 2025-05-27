<?php

use App\Http\Controllers\Auth\AuthencationController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //------------------- Register -------------------//
    Route::get('/register', [RegisterController::class, 'create'])->name('register');

    Route::post('/register', [RegisterController::class, 'store']);

    //------------------- Login -------------------//
    Route::get('/login', [AuthencationController::class, 'create'])->name('login');

    Route::post('/login', [AuthencationController::class, 'store']);

    // ------------------- Password Reset -------------------//
    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPassword'])->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class, 'sendEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset'); // Does not exist in the original code, it in mail verification

    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    //------------------- Logout -------------------//
    Route::post('/logout', [AuthencationController::class, 'destroy'])->name('logout');

    //------------------- Email Verification -------------------//
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    //------------------- Password Confirmation -------------------//
    Route::get('/confirm-password', [ConfirmPasswordController::class, 'create'])->name('password.confirm');

    Route::post('/confirm-password', [ConfirmPasswordController::class, 'store'])->middleware('throttle:6,1');
});
