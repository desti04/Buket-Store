<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tambah kolom hanya jika BELUM ada
        if (!Schema::hasColumn('produk', 'id_kategori')) {
            Schema::table('produk', function (Blueprint $table) {
                // kalau mau simple:
                $table->unsignedBigInteger('id_kategori')->nullable()->after('id');

                // OPSIONAL: kalau mau tambahkan foreign key (kalau memang belum ada)
                // Hati-hati: kalau constraint sudah ada, baris ini bisa error.
                // Jadi lebih aman dilepas dulu, atau kamu pastikan memang belum ada.
                // $table->foreign('id_kategori')->references('id')->on('kategori')->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        // Hapus kolom hanya jika memang ada
        if (Schema::hasColumn('produk', 'id_kategori')) {
            Schema::table('produk', function (Blueprint $table) {
                // Jika kamu sebelumnya menambah FK, drop dulu FK-nya di sini.
                // Nama constraint FK bisa berbeda-beda; kalau tidak yakin, lewati baris dropForeign.
                // $table->dropForeign(['id_kategori']);

                $table->dropColumn('id_kategori');
            });
        }
    }
};
