<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'view'])->name('login.view');
        Route::post('login', [LoginController::class, 'store'])->name('login.store');

        Route::get('register', [RegisterController::class, 'view'])->name('register.view');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');

        Route::get('forgot-password', [ForgotPasswordController::class, 'view'])->name('forgot-password.view');
    });

    Route::middleware('auth')->group(function () {
        Route::any('logout', [LoginController::class, 'destroy'])
            ->name('logout');
    });
});

