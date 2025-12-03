<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\User; 

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

        // Ambil input email & password
        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Cek role user dan redirect sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
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
     * Proses register (POST /register)
     */
    public function register(Request $request)
    {
        // Validasi pendaftaran
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Membuat user baru (default role: user)
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // tambahkan jika perlu
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
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