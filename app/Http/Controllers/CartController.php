<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // TAMPILKAN KERANJANG
    public function index()
    {
        $cart = session('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['qty'] * $item['price'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    // TAMBAH KE KERANJANG
    public function add(Request $request, $id)
    {
        // Ambil data dari form
        $name  = $request->input('name');
        $price = (int) $request->input('price');
        $image = $request->input('image');

        // Ambil keranjang lama dari session
        $cart = session('cart', []);

        // Kalau produk sudah ada → tambah qty
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            // Kalau belum ada → buat item baru
            $cart[$id] = [
                'id'    => $id,
                'name'  => $name,
                'price' => $price,
                'image' => $image,
                'qty'   => 1,
            ];
        }

        // Simpan lagi ke session
        session(['cart' => $cart]);

        return back()->with('success', 'Produk masuk ke keranjang.');
    }

    // UBAH JUMLAH
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            $qty = max(1, (int) $request->input('qty', 1));
            $cart[$id]['qty'] = $qty;
            session(['cart' => $cart]);
        }
        return back();
    }

    // HAPUS SATU ITEM
    public function remove($id)
    {
        $cart = session('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }
        return back();
    }

    // KOSONGKAN KERANJANG
    public function clear()
    {
        session()->forget('cart');
        return back();
    }
}
