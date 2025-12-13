<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * ===============================
     * ADMIN - LIST PRODUK
     * ===============================
     */
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();

        return view('admin.produk.index', compact('produk', 'kategori'));
    }

    /**
     * ===============================
     * ADMIN - SIMPAN PRODUK
     * ===============================
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required|string',
            'id_kategori' => 'required|numeric',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'   => 'nullable|string'
        ]);

        $nama_file = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        Produk::create([
            'nama'        => $request->nama,
            'id_kategori' => $request->id_kategori,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'foto'        => $nama_file,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * ===============================
     * FRONTEND - KATEGORI BUKET BUNGA
     * id_kategori = 1
     * ===============================
     */
    public function buketBunga()
    {
        $products = Produk::where('id_kategori', 1)->get();

        return view('frontend.buket-bunga', compact('products'));
    }

    /**
     * ===============================
     * FRONTEND - KATEGORI BUKET SNACK
     * id_kategori = 2
     * ===============================
     */
    public function buketSnack()
    {
        $products = Produk::where('id_kategori', 2)->get();

        return view('frontend.buket-snack', compact('products'));
    }

    /**
     * ===============================
     * FRONTEND - KATEGORI BUKET UANG
     * id_kategori = 3
     * ===============================
     */
    public function buketUang()
    {
        $products = Produk::where('id_kategori', 3)->get();

        return view('frontend.buket-uang', compact('products'));
    }

    /**
     * ===============================
     * FRONTEND - DETAIL PRODUK
     * ===============================
     */
    public function detail($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);

        return view('frontend.produk_detail', compact('produk'));
    }
}
