@extends('layouts.app')

@section('title', 'Daftar Buket Uang')

@section('content')

<div class="container mx-auto px-4 mt-12 mb-20">

    <h2 class="text-center text-3xl font-bold text-pink-700 mb-10">
        Daftar Buket Uang
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @foreach ($products as $p)
        <div
            onclick="window.location='{{ route('produk.detail', $p->id) }}'"
            class="cursor-pointer bg-white border rounded-xl shadow-md hover:shadow-xl 
                   hover:-translate-y-1 transition-all duration-300 p-3 group">

            <div class="relative overflow-hidden rounded-lg">
                <img src="{{ $p->foto ? asset('images/' . $p->foto) : asset('images/default.jpg') }}"
                     class="w-full h-48 object-cover rounded-lg group-hover:scale-105 duration-300"
                     alt="{{ $p->nama }}">
            </div>

            <p class="text-[15px] mt-3 font-semibold">
                {{ $p->nama }}
            </p>

            <p class="text-[#FF2E00] font-bold text-[15px]">
                Rp {{ number_format($p->harga) }}
            </p>

        </div>
        @endforeach

        @if ($products->isEmpty())
            <p class="col-span-4 text-center text-gray-500">
                Produk buket uang belum tersedia.
            </p>
        @endif

    </div>

</div>

@endsection
