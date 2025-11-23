<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans'; // nama tabel di database

    protected $fillable = [
        'nama_customer',
        'no_hp',
        'total',
        'status',
    ];
}
