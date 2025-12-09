@extends('layouts.app')

@section('content')

<div class="w-full bg-pink-100 pb-10">

    <div id="hero-slider" class="relative w-full overflow-hidden">

        {{-- SPARKLE EFFECT --}}
        <div class="pointer-events-none absolute inset-0 z-20 opacity-50 mix-blend-screen">
            <img src="{{ asset('images/sparkle.png') }}" class="w-full h-full object-cover">
        </div>

        {{-- SLIDE CONTAINER --}}
        <div id="hero-slides" class="flex transition-all duration-700 ease-in-out">

            {{-- SLIDE 1 --}}
            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 1.jpeg') }}"
                     class="w-full h-[380px] md:h-[520px] object-cover">

                <div class="absolute inset-0 bg-gradient-to-r from-white/20 via-transparent to-white/20"></div>

            </div>

            {{-- SLIDE 2 --}}
            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 2.jpeg') }}"
                     class="w-full h-[380px] md:h-[520px] object-cover">

                <div class="absolute inset-0 bg-gradient-to-r from-white/20 via-transparent to-white/20"></div>

            </div>

            {{-- SLIDE 3 --}}
            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 3.png') }}"
                     class="w-full h-[380px] md:h-[520px] object-cover">

                <div class="absolute inset-0 bg-gradient-to-r from-white/20 via-transparent to-white/20"></div>
            </div>

        </div>

        {{-- BUTTON PREV --}}
        <button id="hero-prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 text-pink-600 border border-pink-300 
                       shadow-lg w-10 h-10 rounded-full flex items-center justify-center z-30
                       hover:scale-110 hover:bg-pink-50 transition">
            ‹
        </button>

        {{-- BUTTON NEXT --}}
        <button id="hero-next"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 text-pink-600 border border-pink-300 
                       shadow-lg w-10 h-10 rounded-full flex items-center justify-center z-30
                       hover:scale-110 hover:bg-pink-50 transition">
            ›
        </button>

        {{-- DOT PAGINATION --}}
        <div class="flex justify-center gap-3 mt-4 z-40 relative">
            <button class="w-4 h-4 rounded-full bg-pink-500" data-hero-dot="0"></button>
            <button class="w-4 h-4 rounded-full bg-pink-300" data-hero-dot="1"></button>
            <button class="w-4 h-4 rounded-full bg-pink-300" data-hero-dot="2"></button>
        </div>

    </div>
</div>

{{-- Fade-In CSS --}}
<style>
.fade-slide {
    opacity: 0;
    transition: opacity 1.2s ease-in-out;
}
.fade-slide.active {
    opacity: 1;
}
</style>

{{-- SLIDER SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const slidesContainer = document.getElementById('hero-slides');
    const slides = document.querySelectorAll('.fade-slide');
    const dots = document.querySelectorAll('[data-hero-dot]');
    const totalSlides = slides.length;

    const prevBtn = document.getElementById('hero-prev');
    const nextBtn = document.getElementById('hero-next');

    let index = 0;

    function goToSlide(i) {
        index = (i + totalSlides) % totalSlides;

        slidesContainer.style.transform = `translateX(-${index * 100}%)`;

        slides.forEach(s => s.classList.remove('active'));
        slides[index].classList.add('active');

        dots.forEach((dot, d) => {
            dot.classList.toggle('bg-pink-500', d === index);
            dot.classList.toggle('bg-pink-300', d !== index);
        });
    }

    prevBtn.addEventListener('click', () => goToSlide(index - 1));
    nextBtn.addEventListener('click', () => goToSlide(index + 1));

    dots.forEach((dot, d) => dot.addEventListener('click', () => goToSlide(d)));

    goToSlide(0);

    setInterval(() => goToSlide(index + 1), 6000);
});
</script>


{{-- WAVE + TAGLINE --}}
<div class="relative -mt-2">
    <svg class="w-full" viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill="#ffffff" d="M0,32L48,37.3C96,43,192,53,288,64C384,75,480,85,576,85.3C672,85,768,75,864,74.7C960,75,1056,85,1152,101.3C1248,117,1344,139,1392,149.3L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"/>
    </svg>
</div>

{{-- TAGLINE SECTION (IMPROVED) --}}
<div class="text-center mt-4 mb-10">

    <h3 class="text-pink-700 text-2xl md:text-3xl font-bold tracking-wide drop-shadow-sm">
        “Elegance in Every Petal, Created for Your Special Moments”
    </h3>

    {{-- Larger Floral Icon --}}
    <div class="flex justify-center mt-3">
        <img src="{{ asset('images/floral-icon.png') }}" class="w-16 opacity-90">
    </div>

    {{-- Sub Tagline --}}
    <p class="text-pink-500 text-sm md:text-base mt-3 font-medium">
        Handcrafted with Love • Designed to Make Every Moment Special
    </p>

    {{-- Decorative Divider --}}
    <div class="flex justify-center mt-4">
        <div class="w-40 h-1 rounded-full bg-pink-200 opacity-70"></div>
    </div>

</div>

<!-- KATEGORI -->
<div class="container mx-auto mt-16 px-4">
    <h2 class="text-center text-2xl font-bold text-pink-700 mb-8">Kategori Pilihan</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 justify-items-center">

        <!-- CARD -->
        <div class="bg-gradient-to-b from-pink-100 to-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 p-5 rounded-2xl max-w-sm w-full hover:scale-[1.03] border border-pink-200">
            <div class="w-full h-52 overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset('images/Buket Bunga.jpg') }}" class="w-full h-full object-cover">
            </div>

            <p class="mt-4 font-bold text-pink-700 text-xl">Buket Bunga</p>
        </div>

        <div class="bg-gradient-to-b from-pink-100 to-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 p-5 rounded-2xl max-w-sm w-full hover:scale-[1.03] border border-pink-200">
            <div class="w-full h-52 overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset('images/Buket Snack.jpg') }}" class="w-full h-full object-cover">
            </div>

            <p class="mt-4 font-bold text-pink-700 text-xl">Buket Snack</p>
        </div>

        <div class="bg-gradient-to-b from-pink-100 to-white text-center shadow-lg hover:shadow-2xl transition-all duration-300 p-5 rounded-2xl max-w-sm w-full hover:scale-[1.03] border border-pink-200">
            <div class="w-full h-52 overflow-hidden rounded-xl shadow-md">
                <img src="{{ asset('images/Buket Uang.jpg') }}" class="w-full h-full object-cover">
            </div>

            <p class="mt-4 font-bold text-pink-700 text-xl">Buket Uang</p>
        </div>

    </div>
</div>

<!-- ===================== -->
<!-- REKOMENDASI PRODUK -->
<!-- ===================== -->

<div class="container mx-auto px-4 mt-20">
    <h2 class="text-center text-2xl font-bold text-pink-700">Rekomendasi Untukmu</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">

        @php
            $products = [
                [
                    'img' => 'Buket uang.png',
                    'title' => 'Buket Uang Cantik Premium',
                    'price' => 'Rp 100.000',
                    'description' => 'Buket uang premium elegan untuk hadiah spesial.'
                ],
                [
                    'img' => 'Gambar 2.png',
                    'title' => 'Buket Snack Karakter Pink Lucu',
                    'price' => 'Rp 300.000',
                    'description' => 'Snack karakter lucu cocok untuk kado ulang tahun.'
                ],
                [
                    'img' => 'Gambar 6.png',
                    'title' => 'Buket Bunga Elegan Biru Silver',
                    'price' => 'Rp 200.000',
                    'description' => 'Buket bunga segar warna biru silver yang elegan.'
                ],
                [
                    'img' => 'Foto 1.png',
                    'title' => 'Buket Hijab Eksklusif Pink Nude',
                    'price' => 'Rp 150.000',
                    'description' => 'Buket hijab cantik yang cocok untuk hadiah spesial.'
                ],
            ];
        @endphp

        @foreach ($products as $i => $p)
    @php
        $url = route('produk.detail', ['id' => $i + 1])
            . '?img=' . urlencode($p['img'])
            . '&title=' . urlencode($p['title'])
            . '&price=' . urlencode($p['price'])
            . '&desc=' . urlencode($p['description']);
    @endphp

    <div
        onclick="window.location='{{ $url }}'"
        class="cursor-pointer bg-white border rounded-xl shadow-md hover:shadow-xl
               hover:-translate-y-1 transition-all duration-300 p-3 group">

        <div class="relative overflow-hidden rounded-lg">
            <img src="{{ asset('images/' . $p['img']) }}"
                 class="w-full h-48 object-cover rounded-lg transition-all duration-300 group-hover:scale-105">

            <span class="absolute top-2 left-2 bg-yellow-400 text-[10px] px-2 py-[2px] rounded-full">
                ⭐ Star
            </span>
        </div>

        <p class="text-[14px] mt-3 font-semibold">{{ $p['title'] }}</p>
        <p class="text-pink-600 font-bold text-[15px]">{{ $p['price'] }}</p>
    </div>
@endforeach
</div>

@endsection