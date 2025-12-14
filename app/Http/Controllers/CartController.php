<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Address;

class CartController extends Controller
{
    /*
    |--------------------------------------------------
    | TAMPILKAN KERANJANG
    |--------------------------------------------------
    */
    public function index()
    {
        $cart = session('cart', []);

        $total = collect($cart)->sum(fn ($item) => $item['qty'] * $item['price']);

        return view('cart.index', compact('cart', 'total'));
    }

    /*
    |--------------------------------------------------
    | TAMBAH PRODUK DARI LIST (BUKET BUNGA / DLL)
    |--------------------------------------------------
    */
    public function add($id)
    {
        $produk = Produk::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        } else {
            $cart[$id] = [
                'id'    => $produk->id,
                'name'  => $produk->nama,
                'price' => $produk->harga,
                'image' => $produk->foto,
                'qty'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /*
    |--------------------------------------------------
    | TAMBAH DARI HALAMAN DETAIL
    |--------------------------------------------------
    */
    public function addFromDetail(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $qty    = max(1, (int) $request->qty);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $qty;
        } else {
            $cart[$id] = [
                'id'    => $produk->id,
                'name'  => $produk->nama,
                'price' => $produk->harga,
                'image' => $produk->foto,
                'qty'   => $qty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Produk masuk ke keranjang');
    }

    /*
    |--------------------------------------------------
    | UPDATE JUMLAH PRODUK
    |--------------------------------------------------
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
    |--------------------------------------------------
    | HAPUS ITEM
    |--------------------------------------------------
    */
    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }

    /*
    |--------------------------------------------------
    | KOSONGKAN KERANJANG
    |--------------------------------------------------
    */
    public function clear()
    {
        session()->forget('cart');
        return back();
    }

    /*
    |--------------------------------------------------
    | BUY NOW (LANGSUNG CHECKOUT)
    |--------------------------------------------------
    */
    public function buyNow(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $qty    = max(1, (int) $request->qty);

        $item = [
            'id'    => $produk->id,
            'name'  => $produk->nama,
            'price' => $produk->harga,
            'image' => $produk->foto,
            'qty'   => $qty,
        ];

        $total  = $produk->harga * $qty;
        $alamat = Address::where('user_id', auth()->id())->first();

        return view('cart.checkout', [
            'cart'    => [$item],
            'total'   => $total,
            'alamat'  => $alamat,
            'buy_now' => true,
        ]);
    }

    /*
    |--------------------------------------------------
    | PESAN SEKARANG (langsung add to cart & checkout)
    |--------------------------------------------------
    */
    public function pesanSekarang($id)
    {
        $produk = Produk::findOrFail($id);

    // Ambil keranjang saat ini
    $cart = session()->get('cart', []);

    // Tambahkan produk dengan qty = 1
    $cart[$id] = [
        'id'    => $produk->id,
        'name'  => $produk->nama,
        'price' => $produk->harga,
        'image' => $produk->foto,
        'qty'   => 1,
    ];

    // Simpan ke session
    session()->put('cart', $cart);

    // Redirect ke checkout page
    return redirect()->route('cart.checkout');
}

}
