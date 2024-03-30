<?php

use App\Http\Controllers\Storage\SkinController;
use Illuminate\Support\Facades\Route;

Route::prefix('/storage')->group(function () {
    Route::get('/skin/{username}', [SkinController::class, 'getSkin'])->name('storage.get-skin');
    Route::get('/head/{username}', [SkinController::class, 'getHead'])->name('storage.get-head');
});
