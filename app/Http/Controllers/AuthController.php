<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Tambahkan ini untuk enkripsi password
use App\Models\User; // Tambahkan ini untuk berinteraksi dengan tabel users

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
        // Validasi input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:3',
        ]);

        // Ambil input
        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Arahkan ke dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // ---------------------------------------------------------------- //

    /**
     * Tampilkan form register (GET /register)
     * Tambahan untuk Register
     */
    public function registerForm()
    {
        return view('auth.register'); // Memanggil view register.blade.php
    }

    /**
     * Proses pendaftaran (POST /register)
     * Tambahan untuk Register
     */
    public function register(Request $request)
    {
        // 1. Validasi Data Pendaftaran
        $request->validate([
            'name' => 'required|string|max:255',
            // Email harus unik di tabel users
            'email' => 'required|string|email|max:255|unique:users', 
            // Password minimal 8 karakter dan harus cocok dengan input password_confirmation
            'password' => 'required|string|min:8|confirmed', 
        ]);

        // 2. Membuat User Baru di Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // WAJIB DIENKRIPSI menggunakan Hash
        ]);

        // 3. Pengarahan ke halaman Login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan Login menggunakan akun baru Anda.');
    }

    // ---------------------------------------------------------------- //


    /**
     * Logout (POST)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // invalidate session
        $request->session()->invalidate();

        // regenerate token
        $request->session()->regenerateToken();

        // Di sini saya asumsikan route login Anda bernama 'login'
        return redirect()->route('login'); 
    }
}