<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'view'])->name('login.view');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');

        Route::get('/register', [RegisterController::class, 'view'])->name('register.view');
        Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

        Route::get('/forgot-password', [ForgotPasswordController::class, 'view'])->name('forgot-password.view');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot-password.store');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'view'])->name('reset-password.view');
        Route::post('/reset-password/{token}', [ResetPasswordController::class, 'store'])->name('reset-password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::any('/logout', [LoginController::class, 'destroy'])
            ->name('auth.logout');
    });
});

