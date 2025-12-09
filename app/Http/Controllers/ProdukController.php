<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();

        return view('admin.produk.index', compact('produk', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'id_kategori' => 'required',
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
            'deskripsi'   => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * DETAIL PRODUK (frontend)
     * Saat ini kamu kirim data produk via query string dari home.blade.php,
     * jadi kita ambil dari request query.
     */
    public function detail($id, Request $request)
    {
        $produk = [
            'id'    => $id,
            'img'   => $request->query('img'),
            'title' => $request->query('title'),
            'price' => $request->query('price'),
            'desc'  => $request->query('desc'),
        ];

        return view('frontend.produk_detail', compact('produk'));
    }
}
