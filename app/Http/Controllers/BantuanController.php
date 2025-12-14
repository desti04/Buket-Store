<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'invoice' => 'required',
            'whatsapp' => 'required',
            'jenis_masalah' => 'required',
            'pesan' => 'required',
        ]);

        // sementara redirect + flash message
        return back()->with('success', 'Pesan bantuan berhasil dikirim. Tim kami akan menghubungi Anda.');
    }
}
