<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Address;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * TAMPILKAN SEMUA PESANAN (HALAMAN ADMIN)
     */
    public function index()
    {
        $pesanan = Pesanan::orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

    /**
     * SIMPAN PESANAN DARI CHECKOUT
     */
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong.');
        }

        // Ambil alamat user
        $alamat = Address::where('user_id', auth()->id())->first();

        // Hitung total harga
        $subtotal = collect($cart)->sum(fn ($i) => $i['qty'] * $i['price']);
        $ongkir = 14000;
        $layanan = 2000;

        $total = $subtotal + $ongkir + $layanan;

        // Simpan 1 baris pesanan PER PRODUK (sesuai struktur tabel kamu)
        foreach ($cart as $item) {
            Pesanan::create([
                'user_id'       => auth()->id(),
                'nama_pemesan'  => auth()->user()->name,
                'alamat'        => $alamat ? $alamat->alamat_lengkap : 'Alamat tidak tersedia',
                'produk'        => $item['name'],     // nama produk
                'jumlah'        => $item['qty'],      // qty
                'total_harga'   => $total,            // total sudah termasuk ongkir + layanan
                'image'         => $item['image'],
                'status'        => 'pending',
            ]);
        }

        // Hapus keranjang
        session()->forget('cart');

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * UPDATE STATUS PESANAN (ADMIN)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,selesai,batal',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * HAPUS PESANAN (ADMIN)
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * PRINT LAPORAN PESANAN (ADMIN)
     */
    public function print()
    {
        $pesanan = Pesanan::orderBy('created_at', 'asc')->get();
        return view('admin.pesanan.print', compact('pesanan'));
    }
}
