<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

// Halaman Dashboard Admin
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Produk - versi simple
Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk');

// Tambah Produk
Route::post('/admin/produk/tambah', [ProdukController::class, 'store'])->name('admin.produk.tambah');
