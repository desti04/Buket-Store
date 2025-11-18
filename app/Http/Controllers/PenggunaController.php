<?php

namespace App\Http\Controllers;

use App\Models\User;  // pakai model bawaan Laravel
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    // tampilkan daftar pengguna
    public function index()
    {
        // ambil data user, yang terbaru di atas
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        // kirim ke view
        return view('admin.pengguna.index', compact('users'));
    }
}
