<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans'; // nama tabel di database

    protected $fillable = [
        'user_id',
        'nama_pemesan',
        'alamat',
        'produk',
        'jumlah',
        'total_harga',
        'image',
        'status'
    ];
}
