<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Memberitahu Laravel bahwa nama tabelnya adalah 'kategori' (bukan kategoris)
    protected $table = 'kategori';

    // Memberitahu Laravel bahwa primary key-nya adalah 'id_kategori' (bukan id)
    protected $primaryKey = 'id_kategori';

    // Kolom yang boleh diisi secara massal (create/update)
    protected $fillable = [
        'nama_kategori',
    ];

    // Opsional: Relasi ke Produk (One to Many)
    // Gunanya jika nanti ingin mengambil semua produk dari kategori tertentu
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }
}