<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProduk'   => Produk::count(),
            'totalPesanan'  => Pesanan::count(),
            'totalUser'     => User::where('role', 'customer')->count(), // atau User::count()
            'totalPendapatan' => Pesanan::where('status', 'selesai')->sum('total_harga') // sesuaikan kolom
        ]);
    }
}
