<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    // ===============================
    // BUKET BUNGA
    // ===============================
    public function buketBunga()
    {
        $products = Produk::where('id_kategori', 1)->get();

        return view('frontend.buket-bunga', compact('products'));
    }

    // ===============================
    // BUKET SNACK
    // ===============================
    public function buketSnack()
    {
        $products = Produk::where('id_kategori', 2)->get();

        return view('frontend.buket-snack', compact('products'));
    }

    // ===============================
    // BUKET UANG
    // ===============================
    public function buketUang()
    {
        $products = Produk::where('id_kategori', 3)->get();

        return view('frontend.buket-uang', compact('products'));
    }
}
