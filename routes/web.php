<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/* Controllers */
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('user.dashboard')
        : redirect()->route('login');
})->name('home');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (HANYA TAMU)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register',  [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});


/*
|--------------------------------------------------------------------------
| LOGOUT (HANYA USER LOGIN)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| USER ROUTES (HANYA USER LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* DASHBOARD USER */
    Route::get('/user/dashboard', function () {
        return view('frontend.home');
    })->name('user.dashboard');

    /* Menu Buket */
    Route::get('/buket-bunga', [FrontendController::class, 'buketBunga'])->name('buket.bunga');
    Route::get('/buket-snack', [FrontendController::class, 'buketSnack'])->name('buket.snack');
    Route::get('/buket-uang',  [FrontendController::class, 'buketUang'])->name('buket.uang');

    /* ✅ DETAIL PRODUK (yang dipanggil dari home.blade.php) */
    Route::get('/produk/{id}', [ProdukController::class, 'detail'])
        ->whereNumber('id')
        ->name('produk.detail');

    /* PROFIL USER */
    Route::get('/user/profile', function () {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    })->name('user.profile');

    /* UPDATE PROFIL USER */
    Route::post('/user/profile', function (Request $request) {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email'
        ]);

        $user = Auth::user();
        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui.');
    })->name('user.profile.update');

    /* CART */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (HANYA LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    // Produk
    Route::get('/produk',         [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.tambah');

    // Kategori
    Route::get('/kategori',           [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/tambah',    [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori',          [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}',      [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}',   [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::put('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::get('/pesanan/print', [PesananController::class, 'print'])->name('pesanan.print');

    // Pengguna
    Route::get('/pengguna',           [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/tambah',    [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/tambah',   [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}',      [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}',      [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}',   [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});
