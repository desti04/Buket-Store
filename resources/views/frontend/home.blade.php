<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Beranda</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}" />

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

  <!-- Swiper (pakai CDN agar aman di Laravel) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

  <!-- CSS project Anda -->
  <link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
</head>

<body class="font-manrope bg-white text-gray-900">

  <!-- ============= Header ============= -->
  <header class="bg-gray-dark sticky top-0 z-50 border-b border-white/10">
    <div class="container mx-auto flex justify-between items-center py-4 px-4">

      <!-- Kiri: Logo -->
      <a href="{{ route('user.dashboard') }}" class="flex items-center">
        <img src="{{ asset('images/logo-buket-new.png') }}"
             alt="Logo" class="h-14 w-14 mr-4 rounded-full border border-gray-200 object-cover" />
      </a>

      <!-- Tengah: Menu (desktop) -->
      <nav class="hidden lg:flex md:flex-grow justify-center">
        <ul class="flex justify-center space-x-4 text-white">
          <li><a href="{{ route('user.dashboard') }}" class="hover:text-primary font-semibold">Beranda</a></li>

          <!-- Pria -->
          <li class="relative group" x-data="{ open: false }">
            <a href="#" @mouseover="open = true" @mouseleave="open = false"
               class="hover:text-primary font-semibold flex items-center">
              Pria
              <i :class="open ? 'fas fa-chevron-up ml-1 text-xs' : 'fas fa-chevron-down ml-1 text-xs'"></i>
            </a>
            <ul x-show="open" @mouseover="open = true" @mouseleave="open = false"
                class="absolute left-0 bg-white text-black space-y-2 mt-1 p-2 rounded shadow-lg"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90">
              <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Kemeja Pria</a></li>
              <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Jas Pria</a></li>
              <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Aksesoris Pria</a></li>
            </ul>
          </li>

          <!-- Wanita -->
          <li class="relative group" x-data="{ open: false }">
            <a href="#" @mouseover="open = true" @mouseleave="open = false"
               class="hover:text-primary font-semibold flex items-center">
              Wanita
              <i :class="open ? 'fas fa-chevron-up ml-1 text-xs' : 'fas fa-chevron-down ml-1 text-xs'"></i>
            </a>
            <ul x-show="open" @mouseover="open = true" @mouseleave="open = false"
                class="absolute left-0 bg-white text-black space-y-2 mt-1 p-2 rounded shadow-lg"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90">
              <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Gaun</a></li>
              <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Atasan</a></li>
              <li><a href="shop.html" class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded">Aksesoris</a></li>
            </ul>
          </li>

          <li><a href="shop.html" class="hover:text-primary font-semibold">Toko</a></li>
          <li><a href="single-product-page.html" class="hover:text-primary font-semibold">Produk</a></li>
          <li><a href="404.html" class="hover:text-primary font-semibold">Halaman 404</a></li>
          <li><a href="checkout.html" class="hover:text-primary font-semibold">Checkout</a></li>
        </ul>
      </nav>

      <!-- Kanan: Auth + ikon -->
      <div class="hidden lg:flex items-center space-x-4 relative">
        @guest
          <a href="{{ route('login') }}"
             class="px-4 py-2 bg-gradient-to-r from-blue-600 to-green-400 text-white font-bold rounded-lg border-2 border-green-400 hover:from-green-400 hover:to-blue-600 transform hover:scale-105 transition">
            Masuk
          </a>
        @endguest

        @auth
          <span class="text-white mr-2">Halo, {{ Auth::user()->name }}</span>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="px-4 py-2 bg-transparent text-white border border-green-400 rounded-lg hover:bg-white hover:text-green-600 transform hover:scale-105 transition">
              Keluar
            </button>
          </form>
        @endauth

        <div class="relative group cart-wrapper">
          <a href="/cart.html">
            <img src="{{ asset('assets/images/cart-shopping.svg') }}" alt="Keranjang" class="h-6 w-6 group-hover:scale-120" />
          </a>
        </div>

        <a id="search-icon" href="javascript:void(0);" class="text-white hover:text-primary group">
          <img src="{{ asset('assets/images/search-icon.svg') }}" alt="Cari" class="h-6 w-6 transition-transform transform group-hover:scale-120" />
        </a>

        <!-- Field cari -->
        <div id="search-field" class="hidden absolute top-full right-0 mt-2 w-80 bg-white shadow-lg p-2 rounded">
          <input type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Cari produk..." />
        </div>
      </div>

      <!-- Tombol hamburger (mobile) -->
      <button id="hamburger" class="text-white lg:hidden">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </div>
  </header>

  <!-- ============= Menu Mobile ============= -->
  <nav id="mobile-menu" class="mobile-menu hidden flex-col items-center space-y-4 lg:hidden bg-white border-b border-gray-line py-4">
    <ul class="w-full px-4">
      <li><a href="{{ route('user.dashboard') }}" class="block py-2 font-semibold hover:text-primary">Beranda</a></li>

      <li x-data="{ open: false }" class="border-t border-gray-line pt-2">
        <a @click="open = !open" class="block py-2 font-semibold cursor-pointer flex items-center justify-between">
          <span>Pria</span><i :class="open ? 'fas fa-chevron-up text-xs' : 'fas fa-chevron-down text-xs'"></i>
        </a>
        <ul x-show="open" x-transition class="pl-4 space-y-2">
          <li><a href="shop.html" class="block py-2 hover:text-primary">Kemeja Pria</a></li>
          <li><a href="shop.html" class="block py-2 hover:text-primary">Jas Pria</a></li>
          <li><a href="shop.html" class="block py-2 hover:text-primary">Aksesoris Pria</a></li>
        </ul>
      </li>

      <li x-data="{ open: false }" class="border-t border-gray-line pt-2">
        <a @click="open = !open" class="block py-2 font-semibold cursor-pointer flex items-center justify-between">
          <span>Wanita</span><i :class="open ? 'fas fa-chevron-up text-xs' : 'fas fa-chevron-down text-xs'"></i>
        </a>
        <ul x-show="open" x-transition class="pl-4 space-y-2">
          <li><a href="shop.html" class="block py-2 hover:text-primary">Gaun</a></li>
          <li><a href="shop.html" class="block py-2 hover:text-primary">Atasan</a></li>
          <li><a href="shop.html" class="block py-2 hover:text-primary">Aksesoris</a></li>
        </ul>
      </li>

      <li class="border-t border-gray-line pt-2"><a href="shop.html" class="block py-2 font-semibold hover:text-primary">Toko</a></li>
      <li><a href="single-product-page.html" class="block py-2 font-semibold hover:text-primary">Produk</a></li>
      <li><a href="404.html" class="block py-2 font-semibold hover:text-primary">Halaman 404</a></li>
      <li><a href="checkout.html" class="block py-2 font-semibold hover:text-primary">Checkout</a></li>
    </ul>

    <div class="flex gap-2 px-4 w-full">
      <a href="register.html"
         class="flex-1 bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full text-center hover:bg-transparent hover:text-primary">
        Daftar
      </a>
      <a href="{{ route('login') }}"
         class="flex-1 bg-primary border border-primary text-white font-semibold px-4 py-2 rounded-full text-center hover:bg-transparent hover:text-primary">
        Masuk
      </a>
    </div>
  </nav>

  <!-- ============= Slider Utama ============= -->
  <section id="product-slider" class="relative">
    <div class="swiper main-slider">
      <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide relative">
          <img src="{{ asset('assets/images/main-slider/5.jpg') }}" alt="Slide Wanita" class="w-full h-auto" />
          <div class="swiper-slide-content">
            <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">Wanita</h2>
            <p class="mb-4 text-white md:text-2xl">Koleksi terbaru kami siap melengkapi gaya Anda.</p>
            <a href="/" class="btn-primer-outline-white">Belanja sekarang</a>
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide relative">
          <img src="{{ asset('assets/images/main-slider/2.png') }}" alt="Slide Pria" class="w-full h-auto" />
          <div class="swiper-slide-content">
            <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">Pria</h2>
            <p class="mb-4 text-white md:text-2xl">Tren terkini busana kasual dan olahraga pria.</p>
            <a href="/" class="btn-primer-outline-white">Belanja sekarang</a>
          </div>
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide relative">
          <img src="{{ asset('assets/images/main-slider/4.jpg') }}" alt="Slide Aksesoris" class="w-full h-auto" />
          <div class="swiper-slide-content">
            <h2 class="text-3xl md:text-7xl font-bold text-white mb-2 md:mb-4">Aksesoris</h2>
            <p class="mb-4 text-white md:text-2xl">Lengkapi penampilan Anda dengan aksesoris pilihan.</p>
            <a href="/" class="btn-primer-outline-white">Belanja sekarang</a>
          </div>
        </div>
      </div>

      <!-- Navigasi slider -->
      <div class="swiper-button-prev slider-prev"></div>
      <div class="swiper-button-next slider-next"></div>
    </div>
  </section>

  <!-- ============= Banner Kategori ============= -->
  <section id="product-banners" class="py-10">
    <div class="container mx-auto px-4">
      <div class="flex flex-wrap -mx-4">
        <!-- Kategori 1 -->
        <div class="w-full sm:w-1/3 px-4 mb-8">
          <div class="category-banner relative overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('assets/images/cat-image1.jpg') }}" alt="Kategori Pria" class="w-full h-auto" />
            <div class="absolute inset-0 bg-gray-light bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
              <h2 class="text-2xl md:text-3xl font-bold mb-4">Pria</h2>
              <a href="/" class="btn-primer-outline-white">Belanja sekarang</a>
            </div>
          </div>
        </div>

        <!-- Kategori 2 -->
        <div class="w-full sm:w-1/3 px-4 mb-8">
          <div class="category-banner relative overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('assets/images/cat-image4.jpg') }}" alt="Kategori Wanita" class="w-full h-auto" />
            <div class="absolute inset-0 bg-gray-light bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
              <h2 class="text-2xl md:text-3xl font-bold mb-4">Wanita</h2>
              <a href="/" class="btn-primer-outline-white">Belanja sekarang</a>
            </div>
          </div>
        </div>

        <!-- Kategori 3 -->
        <div class="w-full sm:w-1/3 px-4 mb-8">
          <div class="category-banner relative overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('assets/images/cat-image5.jpg') }}" alt="Kategori Aksesoris" class="w-full h-auto" />
            <div class="absolute inset-0 bg-gray-light bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-4">
              <h2 class="text-2xl md:text-3xl font-bold mb-4">Aksesoris</h2>
              <a href="/" class="btn-primer-outline-white">Belanja sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============= Produk Populer ============= -->
  <section id="popular-products" class="py-6">
    <div class="container mx-auto px-4">
      <h2 class="text-2xl font-bold mb-8">Produk Populer</h2>

      <div class="flex flex-wrap -mx-4">
        <!-- Produk 1 -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <div class="bg-white p-3 rounded-lg shadow-lg">
            <img src="{{ asset('assets/images/products/1.jpg') }}" alt="Produk 1" class="w-full object-cover mb-4 rounded-lg" />
            <a href="#" class="text-lg font-semibold mb-2">Gaun hitam musim panas</a>
            <p class="my-2">Wanita</p>
            <div class="flex items-center mb-4">
              <span class="text-lg font-bold text-primary">$19.99</span>
              <span class="text-sm line-through ml-2">$24.99</span>
            </div>
            <button class="w-full btn-primer">Tambah ke Keranjang</button>
          </div>
        </div>

        <!-- Produk 2 -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <div class="bg-white p-3 rounded-lg shadow-lg">
            <img src="{{ asset('assets/images/products/2.jpg') }}" alt="Produk 2" class="w-full object-cover mb-4 rounded-lg" />
            <a href="#" class="text-lg font-semibold mb-2">Setelan hitam</a>
            <p class="my-2">Wanita</p>
            <div class="flex items-center mb-4">
              <span class="text-lg font-bold text-gray-900">$29.99</span>
            </div>
            <button class="w-full btn-primer">Tambah ke Keranjang</button>
          </div>
        </div>

        <!-- Produk 3 -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <div class="bg-white p-3 rounded-lg shadow-lg">
            <img src="{{ asset('assets/images/products/3.jpg') }}" alt="Produk 3" class="w-full object-cover mb-4 rounded-lg" />
            <a href="#" class="text-lg font-semibold mb-2">Gaun hitam panjang</a>
            <p class="my-2">Wanita, Aksesoris</p>
            <div class="flex items-center mb-4">
              <span class="text-lg font-bold text-gray-900">$15.99</span>
              <span class="text-sm line-through ml-2">$19.99</span>
            </div>
            <button class="w-full btn-primer">Tambah ke Keranjang</button>
          </div>
        </div>

        <!-- Produk 4 -->
        <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
          <div class="bg-white p-3 rounded-lg shadow-lg">
            <img src="{{ asset('assets/images/products/4.jpg') }}" alt="Produk 4" class="w-full object-cover mb-4 rounded-lg" />
            <a href="#" class="text-lg font-semibold mb-2">Jaket kulit hitam</a>
            <p class="my-2">Wanita</p>
            <div class="flex items-center mb-4">
              <span class="text-lg font-bold text-primary">$39.99</span>
              <span class="text-sm line-through ml-2">$49.99</span>
            </div>
            <button class="w-full btn-primer">Tambah ke Keranjang</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ============= Produk Terbaru ============= -->
  <section id="latest-products" class="py-10">
    <div class="container mx-auto px-4">
      <h2 class="text-2xl font-bold mb-8">Produk Terbaru</h2>
      <div class="flex flex-wrap -mx-4">
        <!-- Contoh 4 kartu seperti di atas (disingkat) -->
        @foreach ([5,6,7,8] as $n)
          <div class="w-full sm:w-1/2 lg:w-1/4 px-4 mb-8">
            <div class="bg-white p-3 rounded-lg shadow-lg">
              <img src="{{ asset('assets/images/products/'.$n.'.jpg') }}" alt="Produk {{ $n }}" class="w-full object-cover mb-4 rounded-lg" />
              <a href="#" class="text-lg font-semibold mb-2">Produk {{ $n }}</a>
              <p class="my-2">Kategori</p>
              <div class="flex items-center mb-4">
                <span class="text-lg font-bold text-gray-900">$19.99</span>
                <span class="text-sm line-through ml-2">$24.99</span>
              </div>
              <button class="w-full btn-primer">Tambah ke Keranjang</button>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ============= Brand ============= -->
  <section id="brands" class="bg-white py-16 px-4">
    <div class="container mx-auto max-w-screen-xl">
      <div class="text-center mb-12 lg:mb-20">
        <h2 class="text-4xl font-bold mb-2">Kenali <span class="text-primary">Brand Kami</span></h2>
        <p class="my-4">Jelajahi brand pilihan yang kami hadirkan</p>
      </div>

      <div class="swiper brands-swiper-slider">
        <div class="swiper-wrapper">
          @foreach (['html','js','laravel','php','react','tailwind','typescript'] as $b)
            <div class="swiper-slide bg-gray-200 flex items-center justify-center rounded-md">
              <img src="{{ asset('assets/images/brands/'.$b.'.svg') }}" alt="Logo {{ strtoupper($b) }}" class="max-h-full max-w-full" />
            </div>
          @endforeach
        </div>
        <div class="swiper-button-prev brands-prev"></div>
        <div class="swiper-button-next brands-next"></div>
      </div>
    </div>
  </section>

  <!-- ============= Banner Tengah ============= -->
  <section id="banner" class="relative my-16">
    <div class="container mx-auto px-4 py-20 rounded-lg relative bg-cover bg-center"
         style="background-image: url('{{ asset('assets/images/banner1.jpg') }}');">
      <div class="absolute inset-0 bg-black opacity-40 rounded-lg"></div>
      <div class="relative flex flex-col items-center justify-center h-full text-center text-white py-20">
        <h2 class="text-4xl font-bold mb-4">Selamat Datang di Toko Kami</h2>
        <div class="flex flex-wrap gap-3 justify-center">
          <a href="#" class="btn-primer-outline-white">Belanja Sekarang</a>
          <a href="#" class="btn-primer-outline-white">Produk Baru</a>
          <a href="#" class="btn-primer-outline-white">Promo</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============= Blog ============= -->
  <section class="py-16">
    <div class="text-center mb-12 lg:mb-20">
      <h2 class="text-4xl font-bold mb-2">Temukan <span class="text-primary">Blog</span> Kami</h2>
      <p class="my-4">Tips, tren, dan cerita terbaru seputar fesyen</p>
    </div>

    <div class="container mx-auto px-4 max-w-7xl">
      <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- 3 kartu blog (dipadatkan) -->
        @foreach ([
          ['image'=>'fashion-trends.jpg','tag'=>'Tren Fesyen','title'=>'Tren Kemeja 2024','desc'=>'Rangkuman tren kemeja terpanas tahun ini.'],
          ['image'=>'stylisng-tips.jpg','tag'=>'Tips Styling','title'=>'Padupadan untuk Semua Acara','desc'=>'Cara mudah menata gaya untuk berbagai acara.'],
          ['image'=>'customer-stories.jpg','tag'=>'Cerita Pelanggan','title'=>'Cerita dari Pelanggan Kami','desc'=>'Pengalaman asli dari pelanggan setia kami.'],
        ] as $b)
          <article class="flex flex-col p-6 bg-white rounded-xl shadow-lg">
            <img class="object-cover object-center w-full mb-6 rounded-xl"
                 src="{{ asset('assets/images/'.$b['image']) }}" alt="{{ $b['title'] }}">
            <h2 class="mb-2 text-xs font-semibold tracking-widest text-primary uppercase">{{ $b['tag'] }}</h2>
            <h3 class="mb-3 text-2xl font-semibold text-gray-dark">{{ $b['title'] }}</h3>
            <p class="flex-grow text-base text-gray-txt">{{ $b['desc'] }}</p>
            <div class="mt-6">
              <a href="#" class="btn-primer w-full text-center">Baca selengkapnya</a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>

  <!-- ============= Subscribe ============= -->
  <section id="subscribe" class="py-12 bg-white border-t border-gray-line">
    <div class="container mx-auto px-4">
      <div class="flex flex-col items-center rounded-lg">
        <h2 class="text-center text-xl font-bold sm:text-2xl lg:text-3xl mb-4">
          Gabung newsletter kami dan <span class="text-primary">dapatkan diskon $50</span> untuk pesanan pertama!
        </h2>
        <form class="flex w-full max-w-md gap-2">
          <input placeholder="Masukkan alamat email Anda"
                 class="w-full rounded-full px-3 py-2 border border-gray-300 text-gray-700 placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary" />
          <button class="btn-primer px-5">Berlangganan</button>
        </form>
      </div>
    </div>
  </section>

  <!-- ============= Footer ============= -->
  <footer class="border-t border-gray-line">
    <div class="container mx-auto px-4 py-10">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full sm:w-1/6 px-4 mb-8">
          <h3 class="text-lg font-semibold mb-4">Belanja</h3>
          <ul>
            <li><a href="/shop.html" class="hover:text-primary">Toko</a></li>
            <li><a href="/single-product-page.html" class="hover:text-primary">Wanita</a></li>
            <li><a href="/shop.html" class="hover:text-primary">Pria</a></li>
            <li><a href="/single-product-page.html" class="hover:text-primary">Sepatu</a></li>
            <li><a href="/single-product-page.html" class="hover:text-primary">Aksesoris</a></li>
          </ul>
        </div>

        <div class="w-full sm:w-1/6 px-4 mb-8">
          <h3 class="text-lg font-semibold mb-4">Halaman</h3>
          <ul>
            <li><a href="/shop.html" class="hover:text-primary">Toko</a></li>
            <li><a href="/single-product-page.html" class="hover:text-primary">Produk</a></li>
            <li><a href="/checkout.html" class="hover:text-primary">Checkout</a></li>
            <li><a href="/404.html" class="hover:text-primary">404</a></li>
          </ul>
        </div>

        <div class="w-full sm:w-1/6 px-4 mb-8">
          <h3 class="text-lg font-semibold mb-4">Akun</h3>
          <ul>
            <li><a href="/cart.html" class="hover:text-primary">Keranjang</a></li>
            <li><a href="/register.html" class="hover:text-primary">Daftar</a></li>
            <li><a href="/register.html" class="hover:text-primary">Masuk</a></li>
          </ul>
        </div>

        <div class="w-full sm:w-1/6 px-4 mb-8">
          <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
          <ul class="space-y-2">
            @foreach (['facebook','twitter','instagram','pinterest','youtube'] as $s)
              <li class="flex items-center">
                <img src="{{ asset('assets/images/social_icons/'.$s.'.svg') }}" alt="{{ ucfirst($s) }}" class="w-4 h-4 mr-2">
                <a href="#" class="hover:text-primary">{{ ucfirst($s) }}</a>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="w-full sm:w-2/6 px-4 mb-8">
          <h3 class="text-lg font-semibold mb-4">Kontak Kami</h3>
          <p><img src="{{ asset('assets/images/template-logo.png') }}" alt="Logo" class="h-[60px] mb-4"></p>
          <p>Jalan Contoh No. 123, Jakarta</p>
          <p class="text-xl font-bold my-4">Telepon: (021) 456-7890</p>
          <a href="mailto:info@company.com" class="underline">Email: info@company.com</a>
        </div>
      </div>
    </div>

    <div class="py-6 border-t border-gray-line">
      <div class="container mx-auto px-4 flex flex-wrap justify-between items-center">
        <div class="w-full lg:w-3/4 text-center lg:text-left mb-4 lg:mb-0">
          <p class="mb-2 font-bold">&copy; 2024 Perusahaan Anda. Seluruh hak cipta.</p>
          <ul class="flex justify-center lg:justify-start space-x-4 mb-4">
            <li><a href="#" class="hover:text-primary">Kebijakan Privasi</a></li>
            <li><a href="#" class="hover:text-primary">Syarat Layanan</a></li>
            <li><a href="#" class="hover:text-primary">FAQ</a></li>
          </ul>
          <p class="text-sm">Deskripsi singkat toko Anda—ceritakan keunggulan & layanan Anda di sini.</p>
        </div>
        <div class="w-full lg:w-1/4 text-center lg:text-right">
          <img src="{{ asset('assets/images/social_icons/paypal.svg') }}" alt="PayPal" class="inline-block h-8 mr-2">
          <img src="{{ asset('assets/images/social_icons/stripe.svg') }}" alt="Stripe" class="inline-block h-8 mr-2">
          <img src="{{ asset('assets/images/social_icons/visa.svg') }}" alt="Visa" class="inline-block h-8">
        </div>
      </div>
    </div>
  </footer>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
    // Toggle hamburger
    document.getElementById('hamburger')?.addEventListener('click', () => {
      document.getElementById('mobile-menu')?.classList.toggle('hidden');
    });

    // Toggle pencarian
    document.getElementById('search-icon')?.addEventListener('click', () => {
      document.getElementById('search-field')?.classList.toggle('hidden');
    });

    // Swiper utama
    const mainSlider = new Swiper('.main-slider', {
      loop: true,
      navigation: { nextEl: '.slider-next', prevEl: '.slider-prev' },
      autoplay: { delay: 5000 },
      effect: 'fade'
    });

    // Swiper brand
    const brandsSlider = new Swiper('.brands-swiper-slider', {
      slidesPerView: 2,
      spaceBetween: 16,
      navigation: { nextEl: '.brands-next', prevEl: '.brands-prev' },
      breakpoints: { 640:{slidesPerView:3}, 768:{slidesPerView:4}, 1024:{slidesPerView:6} }
    });
  </script>
</body>
</html>