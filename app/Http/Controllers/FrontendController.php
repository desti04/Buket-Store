<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function buketBunga()
    {
        // ambil produk kategori bunga dari database
        $produkBunga = \App\Models\Produk::where('kategori', 'bunga')->take(10)->get();

        return view('frontend.buket-bunga', compact('produkBunga'));
    }

    public function buketSnack()
    {
        // ambil produk kategori bunga dari database
        $produkSnack = \App\Models\Produk::where('kategori', 'bunga')->take(10)->get();
        
        return view('frontend.buket-snack', compact('produkSnack'));
    }

    public function buketUang()
    {
        // ambil produk kategori bunga dari database
        $produkUang = \App\Models\Produk::where('kategori', 'bunga')->take(10)->get();
        
        return view('frontend.buket-uang', compact('produkUang'));
    }


}

