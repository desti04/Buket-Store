<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Halaman profil user (read-only + kartu ubah/lupa password)
     */
    public function index()
    {
        // view: resources/views/user/profile.blade.php
        return view('user.profile');
    }

    /**
     * Halaman edit profil (nama + no hp, email readonly)
     */
    public function edit()
    {
        $user = Auth::user();

        // view: resources/views/user/profile-edit.blade.php
        return view('user.profile-edit', compact('user'));
    }

    /**
     * Update profil user (nama + no hp)
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        $user->name  = $request->name;
        $user->phone = $request->phone;  // pastikan kolom "phone" sudah ada di tabel users
        // email tidak diupdate di sini
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Halaman ubah password (kalau masih mau pakai halaman terpisah)
     * Route: GET /user/password/change
     */
    public function changePassword()
    {
        return view('user.password');
    }

    /**
     * Proses ubah password
     * Route: POST /user/password/update  (nama route: password.update)
     */
    public function updatePassword(Request $request)
    {
        // validasi dasar
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6',
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'new_password.required'     => 'Password baru wajib diisi.',
            'new_password.min'          => 'Password baru minimal 6 karakter.',
        ]);

        $user = Auth::user();

        // Cek apakah password lama benar
        if (! Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password lama tidak sesuai.'])
                ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation', 'confirm_password']));
        }

        // Ambil nilai konfirmasi dari salah satu input:
        // - new_password_confirmation (modal baru)
        // - atau confirm_password (halaman lama user.password)
        $confirm = $request->input('new_password_confirmation', $request->input('confirm_password'));

        if ($confirm !== $request->new_password) {
            return back()
                ->withErrors(['new_password_confirmation' => 'Konfirmasi password tidak sama dengan password baru.'])
                ->withInput($request->except(['current_password', 'new_password', 'new_password_confirmation', 'confirm_password']));
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // pakai key "password_success" supaya bisa dipakai di profil (modal info)
        return back()->with([
            'password_success' => 'Password berhasil diperbarui.',
            'success'          => 'Password berhasil diperbarui.',
        ]);
    }

    /**
     * Halaman daftar pesanan user
     */
    public function orders()
    {
        $pesanan = \App\Models\Pesanan::where('user_id', auth()->id())->get();

        return view('user.orders', compact('pesanan'));
    }
}
