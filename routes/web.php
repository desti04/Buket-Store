<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;

// ➕ OTP controller
use App\Http\Controllers\Auth\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
| Login user → ke dashboard
| Tamu → ke halaman login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH (TAMU SAJA)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Register
    Route::get('/register',  [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| OTP EMAIL VERIFICATION (boleh diakses tanpa login)
|--------------------------------------------------------------------------
| /verify-email?email=... → form OTP
|--------------------------------------------------------------------------
*/
Route::get('/verify-email',         [VerifyEmailController::class, 'show'])->name('verify.show');
Route::post('/verify-email',        [VerifyEmailController::class, 'verify'])->name('verify.post');
Route::post('/verify-email/resend', [VerifyEmailController::class, 'resend'])->name('verify.resend');

/*
|--------------------------------------------------------------------------
| LOGOUT (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| USER (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard user
    Route::get('/user/dashboard', function () {
        return view('frontend.home');
    })->name('user.dashboard');

    // Katalog
    Route::get('/buket-bunga', [FrontendController::class, 'buketBunga'])->name('buket.bunga');
    Route::get('/buket-snack', [FrontendController::class, 'buketSnack'])->name('buket.snack');
    Route::get('/buket-uang',  [FrontendController::class, 'buketUang'])->name('buket.uang');

    // Profil
    Route::get('/user/profile', function () {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    })->name('user.profile');

    Route::post('/user/profile', function (Request $request) {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        Auth::user()->update($validated);
        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('user.profile.update');

    // Cart
    Route::get('/cart',             [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}',   [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}',[CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}',[CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear',      [CartController::class, 'clear'])->name('cart.clear');
});

/*
|--------------------------------------------------------------------------
| ADMIN (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Produk
    Route::get('/produk',           [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah',   [ProdukController::class, 'store'])->name('produk.tambah');

    // Kategori
    Route::get('/kategori',           [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/tambah',    [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori',          [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}',      [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}',   [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    // Pengguna
    Route::get('/pengguna',           [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/tambah',    [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/tambah',   [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}',      [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}',      [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}',   [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});
