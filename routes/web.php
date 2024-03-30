<?php

use App\Http\Controllers\CabinetController;
use App\Http\Controllers\IndexController;
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
   Route::get('/cabinet', [CabinetController::class, 'view'])->name('cabinet.view');
   Route::post('/cabinet/skin-upload', [CabinetController::class, 'skinUpload'])->name('cabinet.skin-upload');
});

require __DIR__.'/auth.php';
require __DIR__.'/storage.php';
