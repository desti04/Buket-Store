<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    // Tampilkan form register (punyamu sudah ada)
    public function show()
    {
        return view('auth.register');
    }

    // Proses register + kirim OTP
    public function store(Request $request)
    {
        $request->validate([
            'name'                  => ['required','string','max:255'],
            'email'                 => ['required','email','max:255','unique:users,email'],
            'password'              => ['required','confirmed','min:6'],
        ]);

        // Generate OTP 6 digit
        $otpPlain = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Simpan user dengan status belum aktif + simpan HASH OTP
        $user = User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => bcrypt($request->password),
            'role'              => 'customer',
            'status'            => 'inactive',
            'email_verified_at' => null,
            'otp_code'          => hash('sha256', $otpPlain),
            'otp_expires_at'    => Carbon::now()->addMinutes(5),
        ]);

        // Kirim email OTP (pakai queue jika mau: ->queue(new OtpCodeMail($otpPlain)))
        Mail::to($user->email)->send(new OtpCodeMail($otpPlain));

        // Arahkan ke halaman verifikasi OTP
        return redirect()
            ->route('verify.show', ['email' => $user->email])
            ->with('status', 'Kode OTP dikirim ke email kamu.');
    }
}
