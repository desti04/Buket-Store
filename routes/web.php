<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Redirect Root
|--------------------------------------------------------------------------
| Jika user sudah login → ke dashboard.
| Jika belum → ke halaman login.
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Guest Only)
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user yang BELUM login.
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Tampilkan form login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    // Proses login
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| LOGOUT (Auth Required)
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user yang sudah login.
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Auth Required)
|--------------------------------------------------------------------------
| Seluruh route admin hanya bisa diakses user yang sudah login.
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PRODUK
    |--------------------------------------------------------------------------
    */
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.tambah');

    /*
    |--------------------------------------------------------------------------
    | KATEGORI
    |--------------------------------------------------------------------------
    */
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/tambah', [KategoriController::class, 'store'])->name('kategori.tambah');

    /*
    |--------------------------------------------------------------------------
    | PESANAN
    |--------------------------------------------------------------------------
    */
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    /*
    |--------------------------------------------------------------------------
    | PENGGUNA
    |--------------------------------------------------------------------------
    */
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna');
});
