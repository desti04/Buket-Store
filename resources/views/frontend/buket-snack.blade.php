@extends('layouts.app')

@section('title', 'Daftar Buket Snack')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-center text-3xl font-bold text-pink-700 mb-8">Daftar Buket Snack</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
        @foreach([
            ['Snack SilverQueen', 'Rp 50.000'],
            ['Snack Mix', 'Rp 75.000'],
            ['Snack Premium', 'Rp 120.000'],
            ['Snack Choco Delight', 'Rp 90.000'],
            ['Snack Party Pack', 'Rp 150.000'],
            ['Snack Mini Pack', 'Rp 40.000'],
            ['Snack Crunchy', 'Rp 60.000'],
            ['Snack Sweet Pack', 'Rp 80.000'],
            ['Snack Deluxe', 'Rp 200.000'],
            ['Snack Fun Pack', 'Rp 100.000'],
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
