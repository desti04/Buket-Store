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
            'deskripsi'   => 'nullable|string',
        ]);

        $nama_file = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file); // folder konsisten
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
     * ADMIN - TAMPILKAN FORM EDIT
     * ===============================
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();

        return view('admin.produk.edit', compact('produk', 'kategori'));
    }

    /**
     * ===============================
     * ADMIN - UPDATE PRODUK
     * ===============================
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'        => 'required|string',
            'id_kategori' => 'required|numeric',
            'harga'       => 'required|numeric',
            'stok'        => 'required|numeric',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi'   => 'nullable|string',
        ]);

        $produk = Produk::findOrFail($id);

        $nama_file = $produk->foto;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama_file);
        }

        $produk->update([
            'nama'        => $request->nama,
            'id_kategori' => $request->id_kategori,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'foto'        => $nama_file,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * ===============================
     * ADMIN - HAPUS PRODUK
     * ===============================
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }


    /*
     * ===============================
     * FRONTEND PRODUK
     * ===============================
     */
    public function buketBunga()
    {
        $products = Produk::where('id_kategori', 1)->get();
        return view('frontend.buket-bunga', compact('products'));
    }

    public function buketSnack()
    {
        $products = Produk::where('id_kategori', 2)->get();
        return view('frontend.buket-snack', compact('products'));
    }

    public function buketUang()
    {
        $products = Produk::where('id_kategori', 3)->get();
        return view('frontend.buket-uang', compact('products'));
    }

    public function detail($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return view('frontend.produk_detail', compact('produk'));
    }
}
