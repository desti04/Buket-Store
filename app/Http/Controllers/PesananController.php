<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanan'));
    }

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

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return back()->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * Print Laporan Pesanan
     */
    public function print()
    {
        $pesanan = Pesanan::orderBy('created_at', 'asc')->get();
        return view('admin.pesanan.print', compact('pesanan'));
    }
}
