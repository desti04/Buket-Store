<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    // PENTING: id_kategori HARUS ada disini
    protected $fillable = [
        'nama',
        'id_kategori', 
        'harga',
        'stok',
        'foto',
        'deskripsi'
    ];

    // Relasi agar nama kategori muncul di tabel
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}