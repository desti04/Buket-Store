<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\FrontendController;


/*
|--------------------------------------------------------------------------
| FRONTEND (USER) - HALAMAN WEBSITE UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');


/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
|
| Halaman login & register hanya bisa diakses ketika BELUM login (guest).
|
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Register
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


/*
|--------------------------------------------------------------------------
| LOGOUT (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');



/*
|--------------------------------------------------------------------------
| USER DASHBOARD (AUTH REQUIRED)
|--------------------------------------------------------------------------
|
| Dashboard User BUKAN admin.
| Akan dikunjungi oleh pengguna biasa setelah login.
|
*/

Route::middleware('auth')->get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');



/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD + ADMIN PAGES (AUTH REQUIRED)
|--------------------------------------------------------------------------
|
| Semua halaman admin berada di prefix /admin
| dan hanya bisa diakses setelah login.
|
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin (ROLE ADMIN)
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.tambah');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    // Pengguna CRUD
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/tambah', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});
