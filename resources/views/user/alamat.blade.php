@extends('layouts.app')

@section('title', 'Alamat Saya')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">

    <h2 class="text-2xl font-bold text-pink-700 mb-4">Alamat Saya</h2>

    <a href="{{ route('profile.address.create') }}"
       class="px-4 py-2 bg-pink-600 text-white rounded-lg mb-4 inline-block">
       + Tambah Alamat
    </a>

    @forelse ($addresses as $alamat)
        <div class="border p-4 rounded-lg mb-3">
            <p class="font-bold">{{ $alamat->nama_penerima }} ({{ $alamat->no_hp }})</p>
            <p>{{ $alamat->alamat_lengkap }}</p>
            <p>{{ $alamat->kecamatan }}, {{ $alamat->kota }}, {{ $alamat->provinsi }} {{ $alamat->kode_pos }}</p>
        </div>
    @empty
        <p class="text-gray-600">Belum ada alamat tersimpan.</p>
    @endforelse

</div>
@endsection
