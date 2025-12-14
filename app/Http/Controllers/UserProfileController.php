<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Halaman profil user
     */
    public function index()
    {
        return view('user.profile');
    }

    /**
     * Update profil user
     */
   public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $user = Auth::user();

    $user->name = $request->name;   // hanya update nama
    // email tidak diupdate
    $user->save();

    return back()->with('success', 'Profil berhasil diperbarui.');
}


    /**
     * Halaman ubah password
     */
    public function changePassword()
{
    return view('user.password');
}


    /**
     * Proses ubah password
     */
    public function passwordForm()
{
    return view('user.password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);

    $user = Auth::user();

    // Cek apakah password lama benar
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password berhasil diperbarui.');
}

    /**
     * Halaman daftar pesanan user
     */
    public function orders()
    {
        // Ambil semua pesanan milik user yang sedang login
        $pesanan = \App\Models\Pesanan::where('user_id', auth()->id())->get();

        return view('user.orders', compact('pesanan'));
    }
}
