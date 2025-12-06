<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Perhatikan kita pakai Schema::table (untuk EDIT), bukan Schema::create
        Schema::table('produk', function (Blueprint $table) {
            
            // 1. Tambah Kolom
            // Kita taruh setelah kolom 'id' biar rapi
            $table->unsignedBigInteger('id_kategori')->nullable()->after('id');

            // 2. Tambah Relasi (Foreign Key)
            // Pastikan tabel 'kategori' sudah ada sebelumnya!
            $table->foreign('id_kategori')
                  ->references('id')
                  ->on('kategori')
                  ->onDelete('set null'); // Atau 'cascade'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus foreign key dulu (wajib array syntax biar aman)
            $table->dropForeign(['id_kategori']);
            
            // Baru hapus kolomnya
            $table->dropColumn('id_kategori');
        });
    }
};