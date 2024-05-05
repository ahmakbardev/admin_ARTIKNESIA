<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SenimanController;
use App\Livewire\AdminLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', AdminLogin::class)->name('login');

Route::middleware(['auth', 'admin'])->group(function () {
    // Rute-rute untuk admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rute-rute untuk seniman dengan prefix 'seniman'
    Route::prefix('seniman')->group(function () {
        Route::get('/', [SenimanController::class, 'index'])->name('seniman.index');
        // Tambahkan rute-rute lain untuk seniman di sini jika ada
    });
});
