@extends('layouts.app')

@section('title', 'Tambah Alamat')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

    <h2 class="text-2xl font-bold text-pink-700 mb-4">Tambah Alamat Baru</h2>

    <form action="{{ route('profile.address.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label>Nama Penerima</label>
                <input type="text" name="nama_penerima" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label>No HP</label>
                <input type="text" name="no_hp" class="w-full border rounded p-2" required>
            </div>
        </div>

        <label class="mt-3 block">Alamat Lengkap</label>
        <textarea name="alamat_lengkap" class="w-full border rounded p-2" required></textarea>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
            <div>
                <label>Kecamatan</label>
                <input type="text" name="kecamatan" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Kota</label>
                <input type="text" name="kota" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Provinsi</label>
                <input type="text" name="provinsi" class="w-full border rounded p-2" required>
            </div>
        </div>

        <label class="mt-3 block">Kode Pos</label>
        <input type="text" name="kode_pos" class="w-full border rounded p-2" required>

        <button class="mt-5 px-6 py-2 bg-pink-600 text-white rounded-lg">
            Simpan Alamat
        </button>
    </form>
</div>
@endsection
