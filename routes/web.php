<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DataJenjangController;

Auth::routes();

// Upgrade Menggunakan Eloquent
Route::get('/data/jenjang/{id}', [DataJenjangController::class, 'data_jenjang'])->name('data_jenjang');
Route::get('/data/jenjang/{id}/detailsekolah', [DataJenjangController::class, 'data_jenjang_detailsekolah'])->name('data_jenjang_detailsekolah');

// Front End
Route::get('/', [WebController::class, 'index'])->name('homepage');
Route::get('/kecamatan/{id}', [WebController::class, 'kecamatan'])->name('data.kecamatan');
Route::get('/jenjang/{id}', [WebController::class, 'jenjang'])->name('data.jenjang');
Route::get('/detailsekolah/{id}', [WebController::class, 'detailsekolah'])->name('data.detailsekolah');

// Backend
Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('kecamatan')->group(function() {
        Route::get('/', [KecamatanController::class, 'index'])->name('kecamatan');
        Route::get('/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
        Route::post('/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
        Route::get('/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
        Route::put('/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
        Route::get('/delete/{id}', [KecamatanController::class, 'delete'])->name('kecamatan.delete');
    });

    Route::prefix('jenjang')->group(function() {
        Route::get('/', [JenjangController::class, 'index'])->name('jenjang');
        Route::get('/create', [JenjangController::class, 'create'])->name('jenjang.create');
        Route::post('/store', [JenjangController::class, 'store'])->name('jenjang.store');
        Route::get('/edit/{id}', [JenjangController::class, 'edit'])->name('jenjang.edit');
        Route::put('/update/{id}', [JenjangController::class, 'update'])->name('jenjang.update');
        Route::get('/delete/{id}', [JenjangController::class, 'delete'])->name('jenjang.delete');
    });

    Route::prefix('sekolah')->group(function() {
        Route::get('/', [SekolahController::class, 'index'])->name('sekolah');
        Route::get('/create', [SekolahController::class, 'create'])->name('sekolah.create');
        Route::post('/store', [SekolahController::class, 'store'])->name('sekolah.store');
        Route::get('/edit/{id}', [SekolahController::class, 'edit'])->name('sekolah.edit');
        Route::put('/update/{id}', [SekolahController::class, 'update'])->name('sekolah.update');
        Route::get('/delete/{id}', [SekolahController::class, 'delete'])->name('sekolah.delete');
    });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });
});


// Route::get('/', function () {
//     return view('welcome');
// });