<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Halaman Dashboard Admin
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.tambah');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/tambah', [KategoriController::class, 'store'])->name('kategori.tambah');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
