<?php

namespace App\Http\Controllers;

use App\Mail\OtpCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password; // ⬅️ tambah ini

class AuthController extends Controller
{
    /**
     * Tampilkan form login (GET)
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login (POST)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','min:3'],
        ]);

        // Normalisasi email
        $email = strtolower(trim($request->email));
        $credentials = ['email' => $email, 'password' => $request->password];

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput();
        }

        // Sudah terautentikasi, cek status verifikasi
        $user = Auth::user();

        if (is_null($user->email_verified_at) || $user->status !== 'active') {
            $email = $user->email;

            // Logout dulu supaya tidak masuk tanpa verifikasi
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Arahkan ke halaman OTP
            return redirect()
                ->route('verify.show', ['email' => $email])
                ->withErrors(['email' => 'Akun belum terverifikasi. Masukkan kode OTP yang sudah dikirim ke email.']);
        }

        // Jika sudah terverifikasi → lanjut sesuai role
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    // ---------------------------------------------------------------- //

    /**
     * Tampilkan form register (GET /register)
     */
    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Proses register (POST /register) + kirim OTP
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                // MIN 8 + ada huruf + ada angka + ada simbol
                Password::min(8)->letters()->numbers()->symbols(),
            ],
        ], [
            // Pesan tambahan (opsional)
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        // Normalisasi email
        $email = strtolower(trim($request->email));

        // Generate OTP 6 digit
        $otpPlain = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Buat user status belum aktif + simpan HASH OTP (sha256)
        // Catatan: Model User pakai casts ['password' => 'hashed'],
        // jadi cukup kirim password MENTAH. Cast akan auto-hash.
        $user = User::create([
            'name'              => $request->name,
            'email'             => $email,
            'password'          => $request->password,  // auto-hash via cast
            'role'              => 'customer',
            'status'            => 'inactive',
            'email_verified_at' => null,
            'otp_code'          => hash('sha256', $otpPlain),
            'otp_expires_at'    => Carbon::now()->addMinutes(5),
        ]);

        try {
            Mail::to($user->email)->send(new OtpCodeMail($otpPlain));
        } catch (\Throwable $e) {
            return redirect()
                ->route('verify.show', ['email' => $user->email])
                ->withErrors(['email' => 'Gagal mengirim email OTP. Silakan klik "kirim ulang kode".']);
        }

        return redirect()
            ->route('verify.show', ['email' => $user->email])
            ->with('status', 'Kode OTP sudah dikirim ke email kamu. Cek inbox/spam ya!');
    }

    // ---------------------------------------------------------------- //

    /**
     * Logout (POST)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
