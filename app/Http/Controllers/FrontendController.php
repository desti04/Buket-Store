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
        $produkBunga = \App\Models\Produk::where('id_kategori', 1)->take(10)->get();
        return view('frontend.buket-bunga', compact('produkBunga'));
    }

    public function buketSnack()
    {
        $produkSnack = \App\Models\Produk::where('id_kategori', 2)->take(10)->get();
        return view('frontend.buket-snack', compact('produkSnack'));
    }

    public function buketUang()
    {
        $produkUang = \App\Models\Produk::where('id_kategori', 3)->take(10)->get();
        return view('frontend.buket-uang', compact('produkUang'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PRODUK
    |--------------------------------------------------------------------------
    | Mengirim data dari query string (img, title, price, desc)
    |--------------------------------------------------------------------------
    */
    public function detailProduk(Request $request)
    {
        return view('user.product-detail', [
            'img'   => $request->img,
            'title' => $request->title,
            'price' => $request->price,
            'desc'  => $request->desc,
        ]);
    }
}
