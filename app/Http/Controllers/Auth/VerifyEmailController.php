<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class VerifyEmailController extends Controller
{
    // Halaman input OTP
    public function show(Request $request)
    {
        $email = $request->query('email');
        abort_if(!$email, 404);
        return view('auth.verify-otp', compact('email'));
    }

    protected function otpVerifyKey(string $email): string
    {
        return 'otp-verify:' . Str::lower($email);
    }

    protected function otpResendKey(string $email): string
    {
        return 'otp-resend:' . Str::lower($email);
    }

    // Verifikasi OTP
    public function verify(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'otp'   => ['required','digits:6'],
        ]);

        $key = $this->otpVerifyKey($request->email);

        // Limit 5 percobaan per 10 menit
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'otp' => "Terlalu banyak percobaan. Coba lagi dalam {$seconds} detik."
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            RateLimiter::hit($key, 600);
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        if (!$user->otp_code || !$user->otp_expires_at) {
            RateLimiter::hit($key, 600);
            return back()->withErrors(['otp' => 'Tidak ada OTP aktif. Silakan kirim ulang.']);
        }

        if (now()->gt($user->otp_expires_at)) {
            RateLimiter::hit($key, 600);
            return back()->withErrors(['otp' => 'OTP kadaluarsa. Minta kode baru.']);
        }

        // Bandingkan hash OTP
        if (!hash_equals($user->otp_code, hash('sha256', $request->otp))) {
            RateLimiter::hit($key, 600);
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // Berhasil → clear limiter & verifikasi
        RateLimiter::clear($key);

        $user->update([
            'email_verified_at' => now(),
            'status'            => 'active',
            'otp_code'          => null,
            'otp_expires_at'    => null,
        ]);

        return redirect()->route('login')->with('status', 'Email terverifikasi. Silakan login.');
    }

    // Kirim ulang OTP (cooldown 60 detik)
    public function resend(Request $request)
    {
        $request->validate(['email' => ['required','email']]);

        $email = Str::lower($request->email);
        $user  = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan']);
        }

        $cooldownKey = $this->otpResendKey($email);
        if (RateLimiter::tooManyAttempts($cooldownKey, 1)) {
            $seconds = RateLimiter::availableIn($cooldownKey);
            return back()->withErrors(['email' => "Tunggu {$seconds} detik sebelum kirim ulang."]);
        }

        // Set cooldown 60 detik
        RateLimiter::hit($cooldownKey, 60);

        $otpPlain = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'otp_code'       => hash('sha256', $otpPlain),
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(new OtpCodeMail($otpPlain));
        // atau ->queue(new OtpCodeMail($otpPlain));

        return back()->with('status', 'Kode OTP baru telah dikirim.');
    }
}
