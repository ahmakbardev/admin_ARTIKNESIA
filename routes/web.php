<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleImageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SenimanController;
use App\Http\Controllers\WriterController;
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

    Route::get('/admin/karya', [KaryaController::class, 'index'])->name('admin.karya.index');
    Route::post('/admin/karya/update-status/{id}', [KaryaController::class, 'updateStatus'])->name('admin.karya.update-status');
    Route::get('/admin/karya/{id}', [KaryaController::class, 'getKaryaDetail']);

    Route::resource('/admin/article', ArticleController::class)->names('admin.article')->except('show');
    Route::post('/admin/image/upload', [ArticleImageController::class, 'upload'])->name('admin.article.image.upload');

    Route::resource('/admin/writer', WriterController::class)->names('admin.writer')->except('show');

    Route::resource('admin/exhibition', ExhibitionController::class)->names('admin.exhibition')->except('show');
    
    Route::resource('admin/province', ProvinceController::class)->names('admin.province')->except('show');
    Route::resource('admin/city', CityController::class)->names('admin.city')->except('show');
});
