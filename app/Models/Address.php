<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'nama_penerima',
        'no_hp',
        'alamat_lengkap',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'is_main',
    ];
}
