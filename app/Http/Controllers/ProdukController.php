<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori; // Pastikan baris ini ada

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();

        return view('admin.produk.index', compact('produk', 'kategori'));
    }

    // SAYA UBAH NAMANYA DARI 'tambah' MENJADI 'store' AGAR TIDAK ERROR
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nama'        => 'required',
            'id_kategori' => 'required', // Wajib ada
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'   => 'nullable|string'
        ]);

        // 2. Upload Foto
        $nama_file = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        // 3. Simpan
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
}