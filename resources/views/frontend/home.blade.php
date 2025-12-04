@extends('layouts.app')

@section('content')

{{-- SLIDER --}}
<div class="py-5 bg-pink-100">
    <div class="container mx-auto px-4">
        <div id="hero-slider" class="relative w-full max-w-5xl mx-auto">

            <div class="overflow-hidden rounded-2xl shadow-xl bg-white">
                <div id="hero-slides" class="flex transition-transform duration-500 ease-out">

                    {{-- SLIDE 1 --}}
                    <img src="{{ asset('images/Banner 1.png') }}"
                         class="w-full h-72 md:h-[450px] object-contain bg-white flex-shrink-0"
                         alt="Slide 1">

                    {{-- SLIDE 2 --}}
                    <img src="{{ asset('images/Banner 2.png') }}"
                         class="w-full h-72 md:h-[450px] object-contain bg-white flex-shrink-0"
                         alt="Slide 2">

                    {{-- SLIDE 3 --}}
                    <img src="{{ asset('images/banner3.jpg') }}"
                         class="w-full h-72 md:h-[450px] object-cover bg-white flex-shrink-0"
                         alt="Slide 3">
                </div>
            </div>

            {{-- Button nav --}}
            <button id="hero-prev"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white text-pink-600 rounded-full w-10 h-10 shadow flex items-center justify-center">
                ‹
            </button>

            <button id="hero-next"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white text-pink-600 rounded-full w-10 h-10 shadow flex items-center justify-center">
                ›
            </button>

            {{-- DOTS --}}
            <div class="flex justify-center gap-2 mt-3">
                <button class="w-3 h-3 rounded-full bg-pink-500" data-hero-dot="0"></button>
                <button class="w-3 h-3 rounded-full bg-pink-300" data-hero-dot="1"></button>
                <button class="w-3 h-3 rounded-full bg-pink-300" data-hero-dot="2"></button>
            </div>

        </div>
    </div>
</div>

<!-- HERO SECTION -->
<div class="container mx-auto text-center py-10 px-4">
    <h1 class="text-4xl font-bold text-pink-700 mt-5">Order Your Dream Bouquet</h1>
    <button class="mt-6 bg-pink-500 text-white px-6 py-3 rounded-lg hover:bg-pink-600">
        SHOP NOW
    </button>
</div>

<!-- KATEGORI -->
<div class="container mx-auto mt-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 justify-items-center">

        <!-- CARD -->
        <div class="bg-pink-100 text-center shadow-md p-4 rounded-lg max-w-sm w-full">
            <div class="w-full h-48 overflow-hidden rounded-md">
                <img src="{{ asset('images/Buket Bunga.jpg') }}"
                     class="w-full h-full object-cover">
            </div>
            <p class="mt-3 font-semibold text-pink-700 text-lg">
                Buket Bunga Collection
            </p>
        </div>

        <div class="bg-pink-100 text-center shadow-md p-4 rounded-lg max-w-sm w-full">
            <div class="w-full h-48 overflow-hidden rounded-md">
                <img src="{{ asset('images/Buket Snack.jpg') }}"
                     class="w-full h-full object-cover">
            </div>
            <p class="mt-3 font-semibold text-pink-700 text-lg">
                Buket Snack Collection
            </p>
        </div>

        <div class="bg-pink-100 text-center shadow-md p-4 rounded-lg max-w-sm w-full">
            <div class="w-full h-48 overflow-hidden rounded-md">
                <img src="{{ asset('images/Buket Uang.jpg') }}"
                     class="w-full h-full object-cover">
            </div>
            <p class="mt-3 font-semibold text-pink-700 text-lg">
                Buket Uang Collection
            </p>
        </div>

    </div>
</div>



<!-- REKOMENDASI -->
<div class="container mx-auto px-4 mt-12">
    <h2 class="text-center text-2xl font-bold text-pink-700">Rekomendasi</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mt-6">

        {{-- CARD 1 --}}
        <div class="bg-white border border-pink-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 hover:scale-105 transform transition duration-300 p-4 flex flex-col items-center">
            <img src="{{ asset('images/Buket uang.png') }}" class="rounded h-48 w-full object-cover">
            <p class="mt-3 font-semibold text-lg">Buket Uang</p>
            <p class="text-pink-600 font-bold">Rp 100.000</p>

            <div class="grid grid-cols-2 gap-2 mt-3">

                {{-- Tambah Keranjang --}}
                <form action="{{ route('cart.add', 1) }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Buket Uang">
                    <input type="hidden" name="price" value="300000">
                    <input type="hidden" name="image" value="{{ asset('images/rekom-uang.jpg') }}">

                    <button class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 text-sm">
                        🛒 Keranjang
                    </button>
                </form>

                {{-- Pesan --}}
                <button class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 text-sm">
                    Pesan
                </button>

            </div>
        </div>

        {{-- CARD 2 --}}
        <div class="bg-white border border-pink-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 hover:scale-105 transform transition duration-300 p-4 flex flex-col items-center">
            <img src="{{ asset('images/Gambar 2.png') }}" class="rounded h-48 w-full object-cover">
            <p class="mt-3 font-semibold text-lg">Buket Snack</p>
            <p class="text-pink-600 font-bold">Rp 300.000</p>

            <div class="grid grid-cols-2 gap-2 mt-3">
                <form action="{{ route('cart.add', 2) }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Buket Uang Premium">
                    <input type="hidden" name="price" value="300000">
                    <input type="hidden" name="image" value="{{ asset('images/rekom-uang.jpg') }}">

                    <button class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 text-sm">
                        🛒 Keranjang
                    </button>
                </form>

                <button class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 text-sm">
                    Pesan
                </button>
            </div>
        </div>

        {{-- CARD 3 --}}
        <div class="bg-white border border-pink-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 hover:scale-105 transform transition duration-300 p-4 flex flex-col items-center">
            <img src="{{ asset('images/Gambar 6.png') }}" class="rounded h-48 w-full object-cover">
            <p class="mt-3 font-semibold text-lg">Buket Bunga</p>
            <p class="text-pink-600 font-bold">Rp 200.000</p>

            <div class="grid grid-cols-2 gap-2 mt-3">
                <form action="{{ route('cart.add', 3) }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Buket Uang Simple">
                    <input type="hidden" name="price" value="300000">
                    <input type="hidden" name="image" value="{{ asset('images/rekom-uang.jpg') }}">

                    <button class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 text-sm">
                        🛒 Keranjang
                    </button>
                </form>

                <button class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 text-sm">
                    Pesan
                </button>
            </div>
        </div>

        {{-- CARD 4 --}}
        <div class="bg-white border border-pink-200 rounded-lg shadow hover:shadow-xl hover:-translate-y-1 hover:scale-105 transform transition duration-300 p-4 flex flex-col items-center">
            <img src="{{ asset('images/Foto 1.png') }}" class="rounded h-48 w-full object-cover">
            <p class="mt-3 font-semibold text-lg">Buket Hijab</p>
            <p class="text-pink-600 font-bold">Rp 150.000</p>

            <div class="grid grid-cols-2 gap-2 mt-3">
                <form action="{{ route('cart.add', 4) }}" method="POST">
                    @csrf
                    <input type="hidden" name="name" value="Buket Uang Spesial">
                    <input type="hidden" name="price" value="300000">
                    <input type="hidden" name="image" value="{{ asset('images/rekom-uang.jpg') }}">

                    <button class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 text-sm">
                        🛒 Keranjang
                    </button>
                </form>

                <button class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 text-sm">
                    Pesan
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const slidesContainer = document.getElementById('hero-slides');
        const totalSlides = slidesContainer.children.length;
        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        const dots = document.querySelectorAll('[data-hero-dot]');
        let index = 0;

        function goToSlide(i) {
            index = (i + totalSlides) % totalSlides; // biar muter terus
            slidesContainer.style.transform = `translateX(-${index * 100}%)`;
            updateDots();
        }

        function updateDots() {
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-pink-500', i === index);
                dot.classList.toggle('bg-pink-300', i !== index);
            });
        }

        prevBtn.addEventListener('click', () => goToSlide(index - 1));
        nextBtn.addEventListener('click', () => goToSlide(index + 1));

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => goToSlide(i));
        });

        // slide pertama di-set dulu
        goToSlide(0);

        // auto slide tiap 5 detik
        setInterval(() => {
            goToSlide(index + 1);
        }, 5000);
    });
</script>

@endsection
