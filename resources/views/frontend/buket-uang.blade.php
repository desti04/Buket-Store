@extends('layouts.app')

@section('title', 'Daftar Buket Uang')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-center text-3xl font-bold text-pink-700 mb-8">Daftar Buket Uang</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
        @foreach([
            ['Buket Uang 100K', 'Rp 100.000'],
            ['Buket Uang 200K', 'Rp 200.000'],
            ['Buket Uang 300K', 'Rp 300.000'],
            ['Buket Uang 400K', 'Rp 400.000'],
            ['Buket Uang 500K', 'Rp 500.000'],
            ['Buket Uang 600K', 'Rp 600.000'],
            ['Buket Uang 700K', 'Rp 700.000'],
            ['Buket Uang 800K', 'Rp 800.000'],
            ['Buket Uang 900K', 'Rp 900.000'],
            ['Buket Uang 1 Juta', 'Rp 1.000.000'],
        ] as $produk)
        <div class="bg-white border border-pink-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 hover:scale-105 transform transition duration-300 p-4 flex flex-col items-center">
            <img src="https://via.placeholder.com/300x200?text={{ urlencode($produk[0]) }}"
                 alt="{{ $produk[0] }}"
                 class="w-full h-48 object-cover rounded mb-4">
            <h3 class="text-pink-700 font-semibold text-lg mb-1">{{ $produk[0] }}</h3>
            <p class="text-gray-600 mb-3">{{ $produk[1] }}</p>
            <div class="flex gap-2">
                <a href="#" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500">Keranjang</a>
                <a href="#" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Pesan</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
