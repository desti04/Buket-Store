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
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserProfileController;
use App\Models\Address;

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
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // LUPA PASSWORD
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');

        Route::get('/verify-email',         [VerifyEmailController::class, 'show'])->name('verify.show');
Route::post('/verify-email',        [VerifyEmailController::class, 'verify'])->name('verify.post');
Route::post('/verify-email/resend', [VerifyEmailController::class, 'resend'])->name('verify.resend');

});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ===============================
// HALAMAN BUTUH BANTUAN (PUBLIC)
// ===============================
Route::get('/bantuan', function () {
    return view('help');
})->name('bantuan');

/*
|--------------------------------------------------------------------------
| USER ROUTES (LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* DASHBOARD */
    Route::get('/user/dashboard', fn() => view('frontend.home'))
        ->name('user.dashboard');

    /* Menu Buket */
    Route::get('/buket-bunga', [FrontendController::class, 'buketBunga'])->name('buket.bunga');
    Route::get('/buket-snack', [FrontendController::class, 'buketSnack'])->name('buket.snack');
    Route::get('/buket-uang',  [FrontendController::class, 'buketUang'])->name('buket.uang');

    /* ✅ DETAIL PRODUK (yang dipanggil dari home.blade.php) */
    Route::get('/produk/{id}', [ProdukController::class, 'detail'])
        ->whereNumber('id')
        ->name('produk.detail');

    /* DETAIL PRODUK */
    Route::get('/produk/detail', [FrontendController::class, 'detailProduk'])
        ->name('produk.detail');

    /* CART: ADD FROM DETAIL */
    Route::post('/cart/add-detail', [CartController::class, 'addFromDetail'])
        ->name('cart.add.detail');

    /*
    |--------------------------------------------------------------------------
    | BUY NOW + CHECKOUT
    |--------------------------------------------------------------------------
    */

    // BUY NOW → klik Pesan Sekarang
    Route::post('/checkout/buy-now', [CartController::class, 'buyNow'])
        ->name('checkout.buyNow');

    // CHECKOUT NORMAL (keranjang)
    Route::get('/checkout', function () {
        $cart = session('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['qty'] * $i['price']);
        $alamat = Address::where('user_id', auth()->id())->first();

        return view('cart.checkout', compact('cart', 'total', 'alamat'));
    })->name('cart.checkout');


    /*
    |--------------------------------------------------------------------------
    | PROFIL USER
    |--------------------------------------------------------------------------
    */

    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/user/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/user/password/change', [UserProfileController::class, 'changePassword'])->name('password.change');
    Route::post('/user/password/update', [UserProfileController::class, 'updatePassword'])->name('password.update');

    /* ALAMAT */
    Route::get('/user/alamat', [AddressController::class, 'index'])
        ->name('profile.address.index');

    Route::get('/user/alamat/tambah', [AddressController::class, 'create'])
        ->name('profile.address.create');

    Route::post('/user/alamat/tambah', [AddressController::class, 'store'])
        ->name('profile.address.store');

    /* PESANAN USER */
    Route::get('/user/orders', [UserProfileController::class, 'orders'])
        ->name('orders.index');


    /*
    |--------------------------------------------------------------------------
    | CART ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    /* PRODUK */
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.tambah');

    /* KATEGORI */
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    /* PESANAN */
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::put('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::delete('/pesanan/{id}', [PesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::get('/pesanan/print', [PesananController::class, 'print'])->name('pesanan.print');

    /* PENGGUNA */
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/tambah', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/tambah', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])->name('pengguna.show');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
});