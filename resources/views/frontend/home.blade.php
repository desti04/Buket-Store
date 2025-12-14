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
                     class="w-full h-[380px] md:h-[600px] object-cover">
            </div>

            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 2.jpeg') }}"
                     class="w-full h-[380px] md:h-[600px] object-cover">
            </div>

            <div class="relative w-full flex-shrink-0 fade-slide">
                <img src="{{ asset('images/Banner 3.png') }}"
                     class="w-full h-[380px] md:h-[600px] object-cover">
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
                    <img src="{{ asset('images/kategori bunga.jpg') }}" class="w-full h-full object-cover">
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


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const slider = document.getElementById('hero-slider');
  const slides = document.getElementById('hero-slides');
  const items  = slides?.children ? Array.from(slides.children) : [];
  const total  = items.length;

  if (!slider || !slides || total === 0) return;

  // pastikan setiap slide mengambil 100% lebar container
  items.forEach(el => el.style.width = '100%');

  const btnPrev = document.getElementById('hero-prev');
  const btnNext = document.getElementById('hero-next');
  const dots    = document.querySelectorAll('[data-hero-dot]');

  let index = 0;
  let timer = null;

  function setDots() {
    dots.forEach((d, i) => {
      d.classList.toggle('bg-pink-500', i === index);
      d.classList.toggle('bg-pink-300', i !== index);
    });
  }

  function goTo(i) {
    index = (i + total) % total;
    slides.style.transform = `translateX(-${index * 100}%)`;
    setDots();
  }

  function start() {
    stop();
    timer = setInterval(() => goTo(index + 1), 3500);
  }

  function stop() {
    if (timer) clearInterval(timer);
    timer = null;
  }

  // init transform animation
  slides.style.display = 'flex';
  slides.style.transition = 'transform 700ms ease-in-out';
  slides.style.willChange = 'transform';

  goTo(0);
  start();

  btnPrev?.addEventListener('click', () => { goTo(index - 1); start(); });
  btnNext?.addEventListener('click', () => { goTo(index + 1); start(); });

  dots.forEach(d => {
    d.addEventListener('click', () => {
      goTo(parseInt(d.dataset.heroDot, 10));
      start();
    });
  });

  // pause saat hover
  slider.addEventListener('mouseenter', stop);
  slider.addEventListener('mouseleave', start);

  // stop saat tab tidak aktif
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) stop();
    else start();
  });
});
</script>
@endpush
