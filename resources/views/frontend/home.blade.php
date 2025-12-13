@extends('layouts.app')

@section('content')

<div class="w-full bg-pink-100 pb-10">

    {{-- ================= HERO SLIDER ================= --}}
    <div id="hero-slider" class="relative w-full overflow-hidden">

        <div class="pointer-events-none absolute inset-0 z-20 opacity-50 mix-blend-screen">
            <img src="{{ asset('images/sparkle.png') }}" class="w-full h-full object-cover">
        </div>

        <div id="hero-slides" class="flex transition-all duration-700 ease-in-out">

            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 1.jpeg') }}"
                     class="w-full h-[380px] md:h-[520px] object-cover">
            </div>

            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 2.jpeg') }}"
                     class="w-full h-[380px] md:h-[520px] object-cover">
            </div>

            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 3.png') }}"
                     class="w-full h-[380px] md:h-[520px] object-cover">
            </div>

        </div>

        <button id="hero-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 text-pink-600 border
                   shadow-lg w-10 h-10 rounded-full hover:scale-110 transition">‹</button>

        <button id="hero-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 text-pink-600 border
                   shadow-lg w-10 h-10 rounded-full hover:scale-110 transition">›</button>

        <div class="flex justify-center gap-3 mt-4">
            <button class="w-4 h-4 rounded-full bg-pink-500" data-hero-dot="0"></button>
            <button class="w-4 h-4 rounded-full bg-pink-300" data-hero-dot="1"></button>
            <button class="w-4 h-4 rounded-full bg-pink-300" data-hero-dot="2"></button>
        </div>
    </div>
</div>

{{-- ================= TAGLINE ================= --}}
<div class="text-center mt-6 mb-14">
    <h3 class="text-pink-700 text-2xl md:text-3xl font-bold">
        “Elegance in Every Petal, Created for Your Special Moments”
    </h3>

    <div class="flex justify-center mt-3">
        <img src="{{ asset('images/floral-icon.png') }}" class="w-16 opacity-90">
    </div>

    <p class="text-pink-500 mt-3">
        Handcrafted with Love • Designed to Make Every Moment Special
    </p>
</div>

{{-- ================= KATEGORI ================= --}}
<div class="container mx-auto mt-16 px-4">
    <h2 class="text-center text-2xl font-bold text-pink-700 mb-8">
        Kategori Pilihan
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">

        {{-- BUKET BUNGA --}}
        <a href="{{ route('produk.buket') }}" class="block">
            <div class="bg-gradient-to-b from-pink-100 to-white text-center shadow-lg
                        hover:shadow-2xl p-5 rounded-2xl max-w-sm hover:scale-[1.03] transition">
                <div class="h-52 overflow-hidden rounded-xl">
                    <img src="{{ asset('images/Buket Bunga.jpg') }}" class="w-full h-full object-cover">
                </div>
                <p class="mt-4 font-bold text-pink-700 text-xl">Buket Bunga</p>
            </div>
        </a>

        {{-- BUKET SNACK --}}
        <a href="{{ route('produk.snack') }}" class="block">
            <div class="bg-gradient-to-b from-pink-100 to-white text-center shadow-lg
                        hover:shadow-2xl p-5 rounded-2xl max-w-sm hover:scale-[1.03] transition">
                <div class="h-52 overflow-hidden rounded-xl">
                    <img src="{{ asset('images/Buket Snack.jpg') }}" class="w-full h-full object-cover">
                </div>
                <p class="mt-4 font-bold text-pink-700 text-xl">Buket Snack</p>
            </div>
        </a>

        {{-- BUKET UANG --}}
        <a href="{{ route('produk.uang') }}" class="block">
            <div class="bg-gradient-to-b from-pink-100 to-white text-center shadow-lg
                        hover:shadow-2xl p-5 rounded-2xl max-w-sm hover:scale-[1.03] transition">
                <div class="h-52 overflow-hidden rounded-xl">
                    <img src="{{ asset('images/Buket Uang.jpg') }}" class="w-full h-full object-cover">
                </div>
                <p class="mt-4 font-bold text-pink-700 text-xl">Buket Uang</p>
            </div>
        </a>

    </div>
</div>

@endsection
