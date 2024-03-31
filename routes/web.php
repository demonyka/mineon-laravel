<?php

use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\Cabinet\Security\ChangePasswordController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Storage\SkinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'view'])->name('index.view');

Route::middleware('auth')->group(function () {
    Route::prefix('/cabinet')->group(function () {
        Route::get('/', [CabinetController::class, 'view'])->name('cabinet.view');
        Route::post('/skin-upload', [SkinController::class, 'skinUpload'])->name('cabinet.skin-upload');
        Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('change-password.store');
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/storage.php';
