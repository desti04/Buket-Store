@extends('layouts.app')

@section('title', 'Daftar Buket Snack')

@section('content')

<div class="container mx-auto px-4 mt-12 mb-20">

    <h2 class="text-center text-3xl font-bold text-pink-700 mb-10">
        Daftar Buket Snack
    </h2>

    @php
        $snacks = [
            ['img' => 'snack1.jpg', 'title' => 'Buket Snack Karakter Pink Lucu', 'price' => 'Rp 300.000', 'desc' => 'Buket snack karakter warna pink.'],
            ['img' => 'snack2.jpg', 'title' => 'Buket Snack Coklat Premium', 'price' => 'Rp 250.000', 'desc' => 'Coklat premium bentuk buket mewah.'],
            ['img' => 'snack3.jpg', 'title' => 'Buket Snack Mix Colorful', 'price' => 'Rp 220.000', 'desc' => 'Mix snack warna-warni ceria.'],
            ['img' => 'snack4.jpg', 'title' => 'Buket Snack Karakter Boneka', 'price' => 'Rp 280.000', 'desc' => 'Snack + boneka hadiah lucu.'],

            ['img' => 'snack5.jpg', 'title' => 'Buket Snack Jumbo', 'price' => 'Rp 350.000', 'desc' => 'Snack super banyak untuk hadiah spesial.'],
            ['img' => 'snack6.jpg', 'title' => 'Buket Snack Hitam Gold', 'price' => 'Rp 270.000', 'desc' => 'Tema elegan hitam emas.'],
            ['img' => 'snack7.jpg', 'title' => 'Buket Snack Biru Pastel', 'price' => 'Rp 230.000', 'desc' => 'Nuansa biru pastel lembut.'],
            ['img' => 'snack8.jpg', 'title' => 'Buket Snack Pink Soft', 'price' => 'Rp 240.000', 'desc' => 'Snack pink yang manis & cantik.'],

            ['img' => 'snack9.jpg', 'title' => 'Buket Snack Merah Ceria', 'price' => 'Rp 260.000', 'desc' => 'Tema merah ceria penuh energi.'],
            ['img' => 'snack10.jpg', 'title' => 'Buket Snack Anime Edition', 'price' => 'Rp 290.000', 'desc' => 'Dengan karakter anime favorit.'],
            ['img' => 'snack11.jpg', 'title' => 'Buket Snack Mini Gift', 'price' => 'Rp 150.000', 'desc' => 'Ukuran kecil tapi tetap cantik.'],
            ['img' => 'snack12.jpg', 'title' => 'Buket Snack Rainbow', 'price' => 'Rp 280.000', 'desc' => 'Snack campuran warna rainbow cerah.'],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach ($snacks as $p)
        <div onclick="window.location='{{ route('produk.detail') }}?img={{ urlencode($p['img']) }}&title={{ urlencode($p['title']) }}&price={{ urlencode($p['price']) }}&desc={{ urlencode($p['desc']) }}'"
             class="cursor-pointer bg-white border rounded-xl shadow-md hover:shadow-xl 
                    hover:-translate-y-1 transition-all duration-300 p-3 group">

            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ asset('images/'.$p['img']) }}"
                     class="w-full h-48 object-cover rounded-lg group-hover:scale-105 duration-300">
            </div>

            <p class="text-[15px] mt-3 font-semibold">{{ $p['title'] }}</p>
            <p class="text-[#FF2E00] font-bold text-[15px]">{{ $p['price'] }}</p>
        </div>
        @endforeach

    </div>

</div>

@endsection
