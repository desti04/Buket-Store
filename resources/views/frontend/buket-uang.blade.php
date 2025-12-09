@extends('layouts.app')

@section('title', 'Daftar Buket Uang')

@section('content')

<div class="container mx-auto px-4 mt-12 mb-20">

    <h2 class="text-center text-3xl font-bold text-pink-700 mb-10">
        Daftar Buket Uang
    </h2>

    @php
        $uang = [
            ['img' => 'uang1.jpg', 'title' => 'Buket Uang Cantik Premium', 'price' => 'Rp 100.000', 'desc' => 'Buket uang premium elegan.'],
            ['img' => 'uang2.jpg', 'title' => 'Buket Uang Biru Silver', 'price' => 'Rp 200.000', 'desc' => 'Tema biru elegan mewah.'],
            ['img' => 'uang3.jpg', 'title' => 'Buket Uang Pink Soft', 'price' => 'Rp 150.000', 'desc' => 'Nuansa pink lembut.'],
            ['img' => 'uang4.jpg', 'title' => 'Buket Uang Hijau Pastel', 'price' => 'Rp 180.000', 'desc' => 'Hijau pastel segar & elegan.'],

            ['img' => 'uang5.jpg', 'title' => 'Buket Uang Merah Mewah', 'price' => 'Rp 210.000', 'desc' => 'Merah elegan untuk hadiah.'],
            ['img' => 'uang6.jpg', 'title' => 'Buket Uang Jumbo 50K', 'price' => 'Rp 250.000', 'desc' => 'Penuh uang pecahan 50 ribu.'],
            ['img' => 'uang7.jpg', 'title' => 'Buket Uang Gold Elegant', 'price' => 'Rp 300.000', 'desc' => 'Tema gold super mewah.'],
            ['img' => 'uang8.jpg', 'title' => 'Buket Uang Pastel Mix', 'price' => 'Rp 170.000', 'desc' => 'Campuran pastel lembut.'],

            ['img' => 'uang9.jpg', 'title' => 'Buket Uang Exclusive', 'price' => 'Rp 350.000', 'desc' => 'Model sangat mewah.'],
            ['img' => 'uang10.jpg', 'title' => 'Buket Uang Pink Nude', 'price' => 'Rp 190.000', 'desc' => 'Pink nude elegan.'],
            ['img' => 'uang11.jpg', 'title' => 'Buket Uang Premium Silver', 'price' => 'Rp 280.000', 'desc' => 'Silver premium royal.'],
            ['img' => 'uang12.jpg', 'title' => 'Buket Uang Butterfly', 'price' => 'Rp 320.000', 'desc' => 'Dengan hiasan butterfly cantik.'],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach ($uang as $p)
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
