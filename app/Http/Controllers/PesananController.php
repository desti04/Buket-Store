<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        // Ambil semua data pesanan dari database
        $pesanan = Pesanan::orderBy('created_at', 'desc')->get();

        // Kirim data ke tampilan (view) index.blade.php
        return view('admin.pesanan.index', compact('pesanan'));
    }
}
