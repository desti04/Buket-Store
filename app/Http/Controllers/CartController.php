<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN KERANJANG
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $cart = session('cart', []);

        $total = collect($cart)->sum(fn($item) => $item['qty'] * $item['price']);

        return view('cart.index', compact('cart', 'total'));
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH PRODUK DARI HALAMAN LIST / LOOP
    |--------------------------------------------------------------------------
    */
    public function add(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        $name  = $request->name;
        $price = (int) $request->price;
        $image = $request->image;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id'    => $id,
                'name'  => $name,
                'price' => $price,
                'image' => $image,
                'qty'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk masuk ke keranjang!');
    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH DARI HALAMAN DETAIL
    |--------------------------------------------------------------------------
    */
    public function addFromDetail(Request $request)
    {
        $cart = session()->get('cart', []);

        $name  = $request->title;
        $price = (int) str_replace(['Rp', '.', ' '], '', $request->price);
        $image = $request->img;
        $qty   = (int) $request->qty;

        // Unique ID (menghindari duplikasi ketika produk sama ditambah lagi)
        $id = md5($name . $image);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'id'    => $id,
                'name'  => $name,
                'price' => $price,
                'image' => $image,
                'qty'   => $qty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
                         ->with('success', 'Produk masuk ke keranjang!');
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE JUMLAH PRODUK
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, (int) $request->qty);
        }

        session()->put('cart', $cart);

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | HAPUS ITEM KERANJANG
    |--------------------------------------------------------------------------
    */
    public function remove($id)
    {
        $cart = session('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | KOSONGKAN KERANJANG
    |--------------------------------------------------------------------------
    */
    public function clear()
    {
        session()->forget('cart');

        return back();
    }


    /*
    |--------------------------------------------------------------------------
    | BUY NOW — Langsung Checkout TANPA Masuk Keranjang
    |--------------------------------------------------------------------------
    */
    public function buyNow(Request $request)
    {
        $item = [
            'image' => $request->image,
            'name'  => $request->title,
            'price' => (int) str_replace(['Rp', '.', ' '], '', $request->price),
            'qty'   => (int) $request->qty,
        ];

        $total = $item['qty'] * $item['price'];

        // Ambil alamat utama user
        $alamat = Address::where('user_id', auth()->id())->first();

        return view('cart.checkout', [
            'cart'    => [$item], // 1 produk buy now
            'total'   => $total,
            'alamat'  => $alamat,
            'buy_now' => true,
        ]);
    }
}
