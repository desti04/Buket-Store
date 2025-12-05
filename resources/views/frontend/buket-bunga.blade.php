@extends('layouts.app')

@section('title', 'Daftar Buket Bunga')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-center text-3xl font-bold text-pink-700 mb-8">Daftar Buket Bunga</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6">
        @foreach([
            ['Rose Elegan', 'Rp 120.000'],
            ['Tulip Ceria', 'Rp 135.000'],
            ['Lily Putih', 'Rp 150.000'],
            ['Mawar Merah', 'Rp 160.000'],
            ['Bunga Matahari', 'Rp 110.000'],
            ['Orchid Ungu', 'Rp 180.000'],
            ['Mix Pastel', 'Rp 200.000'],
            ['Bunga Kering Vintage', 'Rp 125.000'],
            ['Buket Mini', 'Rp 95.000'],
            ['Buket Premium', 'Rp 250.000'],
        ] as $buket)
                <div class="bg-white border border-pink-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 hover:scale-105 transform transition duration-300 p-4 flex flex-col items-center">
            <img src="https://via.placeholder.com/300x200?text={{ urlencode($buket[0]) }}"
                 alt="{{ $buket[0] }}"
                 class="w-full h-48 object-cover rounded mb-4">
            <h3 class="text-pink-700 font-semibold text-lg mb-1">{{ $buket[0] }}</h3>
            <p class="text-gray-600 mb-3">{{ $buket[1] }}</p>
            <div class="flex gap-2">
                <a href="#" class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500">Keranjang</a>
                <a href="#" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Pesan</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
