<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Data contoh dulu
        $kategori = [
            (object) ['id' => 1, 'nama' => 'Buket Wisuda', 'deskripsi' => 'Buket khusus untuk wisuda'],
            (object) ['id' => 2, 'nama' => 'Buket Ulang Tahun', 'deskripsi' => 'Buket spesial ulang tahun'],
        ];

        return view('admin.kategori.index', compact('kategori'));
    }

    // 👉 FORM TAMBAH
    public function create()
    {
        return view('admin.kategori.create');
    }

    // 👉 PROSES SIMPAN
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        // Nanti di sini kamu bisa simpan ke database.
        // Untuk sementara, kita cuma balik ke index dengan pesan sukses.
        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan (dummy, belum tersimpan ke DB).');
    }
}



