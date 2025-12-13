<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;

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

    // RESET PASSWORD
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');

    // VERIFY EMAIL
    Route::get('/verify-email', [VerifyEmailController::class, 'show'])->name('verify.show');
    Route::post('/verify-email', [VerifyEmailController::class, 'verify'])->name('verify.post');
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

/*
|--------------------------------------------------------------------------
| USER ROUTES (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    | DASHBOARD
    */
    Route::get('/user/dashboard', fn () => view('frontend.home'))
        ->name('user.dashboard');

    /*
    | PRODUK
    */
    Route::get('/buket-bunga', [ProdukController::class, 'buketBunga'])->name('produk.buket');
    Route::get('/buket-snack', [ProdukController::class, 'buketSnack'])->name('produk.snack');
    Route::get('/buket-uang',  [ProdukController::class, 'buketUang'])->name('produk.uang');

    Route::get('/produk/{id}', [ProdukController::class, 'detail'])
        ->whereNumber('id')
        ->name('produk.detail');

    /*
    | CART
    */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add-detail/{id}', [CartController::class, 'addFromDetail'])->name('cart.add.detail');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    /*
    | CHECKOUT
    */
    Route::get('/checkout', function () {
        $cart   = session('cart', []);
        $total  = collect($cart)->sum(fn ($i) => $i['qty'] * $i['price']);
        $alamat = Address::where('user_id', auth()->id())->first();

        return view('cart.checkout', compact('cart', 'total', 'alamat'));
    })->name('cart.checkout');

    Route::post('/checkout/buy-now/{id}', [CartController::class, 'buyNow'])
        ->name('checkout.buyNow');

    /*
    | PESANAN
    */
    Route::post('/pesanan/store', [PesananController::class, 'store'])
        ->name('pesanan.store');

    /*
    | ALAMAT PENGIRIMAN
    */
    Route::get('/user/address', [AddressController::class, 'index'])
        ->name('profile.address.index');

    Route::get('/user/address/create', [AddressController::class, 'create'])
        ->name('profile.address.create');

    Route::post('/user/address/store', [AddressController::class, 'store'])
        ->name('profile.address.store');

    /*
    | PROFIL
    */
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/user/profile/update', [UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/user/password/change', [UserProfileController::class, 'changePassword'])->name('password.change');
    Route::post('/user/password/update', [UserProfileController::class, 'updatePassword'])->name('password.update');

    Route::get('/user/orders', [UserProfileController::class, 'orders'])->name('orders.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (FIXED + COMPLETE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

    // Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk/tambah', [ProdukController::class, 'store'])->name('produk.tambah');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

    Route::put('/pesanan/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

    // PRINT LAPORAN
    Route::get('/pesanan/print', [PesananController::class, 'print'])->name('pesanan.print');

    // PENGGUNA (CRUD)
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna/store', [PenggunaController::class, 'store'])->name('pengguna.store');

    // SHOW (Detail)
    Route::get('/pengguna/{id}', [PenggunaController::class, 'show'])->name('pengguna.show');

    // EDIT
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');

    // UPDATE
    Route::post('/pengguna/{id}/update', [PenggunaController::class, 'update'])->name('pengguna.update');

    // DESTROY (Hapus) — NAMA HARUS SAMA DENGAN YANG DI BLADE
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');

});
