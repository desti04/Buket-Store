@extends('layouts.app')

@section('title', 'Daftar Buket Bunga')

@section('content')

<div class="container mx-auto px-4 mt-12 mb-16">

    <h2 class="text-center text-3xl font-bold text-pink-700 mb-10">
        Daftar Buket Bunga
    </h2>

    @php
        $products = [
            ['img' => 'bunga1.jpg', 'title' => 'Rose Elegan', 'price' => 'Rp 120.000', 'desc' => 'Buket mawar elegan.'],
            ['img' => 'bunga2.jpg', 'title' => 'Tulip Ceria', 'price' => 'Rp 135.000', 'desc' => 'Buket tulip warna-warni.'],
            ['img' => 'bunga3.jpg', 'title' => 'Lily Putih', 'price' => 'Rp 150.000', 'desc' => 'Lily putih kesucian.'],
            ['img' => 'bunga4.jpg', 'title' => 'Mawar Merah', 'price' => 'Rp 160.000', 'desc' => 'Mawar merah romantis.'],
            ['img' => 'bunga5.jpg', 'title' => 'Bunga Matahari', 'price' => 'Rp 110.000', 'desc' => 'Sunflower ceria dan cerah.'],
            ['img' => 'bunga6.jpg', 'title' => 'Bouquet Pink Soft', 'price' => 'Rp 140.000', 'desc' => 'Dominasi warna pink lembut.'],
            ['img' => 'bunga7.jpg', 'title' => 'Bouquet Ungu Lavender', 'price' => 'Rp 170.000', 'desc' => 'Lavender wangi dan elegan.'],
            ['img' => 'bunga8.jpg', 'title' => 'Bouquet Mix Pastel', 'price' => 'Rp 180.000', 'desc' => 'Kombinasi pastel cantik.'],
            ['img' => 'bunga9.jpg', 'title' => 'Bouquet Biru Frozen', 'price' => 'Rp 155.000', 'desc' => 'Nuansa biru es elegan.'],
            ['img' => 'bunga10.jpg', 'title' => 'Bouquet Sweet Red', 'price' => 'Rp 160.000', 'desc' => 'Mawar merah premium.'],
            ['img' => 'bunga11.jpg', 'title' => 'Bouquet Peach Glam', 'price' => 'Rp 145.000', 'desc' => 'Peach hangat dan manis.'],
            ['img' => 'bunga12.jpg', 'title' => 'Bouquet White Gold', 'price' => 'Rp 200.000', 'desc' => 'Elegan putih emas mewah.'],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach ($products as $p)
        
        <div 
            onclick="window.location='{{ route('produk.detail') }}?img={{ urlencode($p['img']) }}&title={{ urlencode($p['title']) }}&price={{ urlencode($p['price']) }}&desc={{ urlencode($p['desc']) }}'"
            class="cursor-pointer bg-white border rounded-xl shadow-md hover:shadow-xl 
                   hover:-translate-y-1 transition-all duration-300 p-3 group">

            {{-- GAMBAR --}}
            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('images/' . $p['img']) }}" 
                     class="w-full h-48 object-cover rounded-lg transition-all duration-300 group-hover:scale-105">
            </div>

            {{-- NAMA --}}
            <p class="text-[15px] mt-3 font-semibold">{{ $p['title'] }}</p>

            {{-- HARGA --}}
            <p class="text-[#FF2E00] font-bold text-[15px]">{{ $p['price'] }}</p>

        </div>

        @endforeach

    </div>

</div>

@endsection
