<!-- resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>@yield('title', 'Bouquetde Fleur')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
/* === FOOTER LOGO MAYOBOX STYLE === */
@keyframes floatSoft {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

.footer-logo {
    animation: floatSoft 4s ease-in-out infinite;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.footer-logo:hover {
    transform: scale(1.08) rotate(-3deg);
    box-shadow: 0 0 25px rgba(255, 105, 180, 0.6);
}
</style>
</head>

<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <header class="shadow-sm bg-pink-100">
        @includeIf('partials.navbar')
    </header>

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-pink-300 text-white pt-14 pb-6 mt-20">

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

        {{-- KOLOM 1 : LOGO & DESKRIPSI --}}
        <div>
            <img src="{{ asset('images/logo buket new.png') }}"
            class="footer-logo w-28 mb-4 rounded-full bg-white p-2 cursor-pointer"
            alt="Bouquetde Fleur">


            <p class="text-sm leading-relaxed text-white/90">
                Bouquetde Fleur adalah pilihan terbaik untuk berbagai jenis buket
                bunga, snack, dan uang dengan desain elegan dan kualitas terbaik.
            </p>
        </div>

        {{-- KOLOM 2 : INFORMASI --}}
        <div>
            <h3 class="font-semibold text-lg mb-4">Informasi</h3>
            <ul class="space-y-2 text-sm text-white/90">
                <li><a href="#" class="hover:underline">FAQ (Pertanyaan Umum)</a></li>
                <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
            </ul>
        </div>

        {{-- KOLOM 3 : HUBUNGI KAMI --}}
        <div>
            <h3 class="font-semibold text-lg mb-4">Hubungi Kami</h3>
            <ul class="space-y-2 text-sm text-white/90">
                <li>Instagram : @bouquetdefleur17</li>
                <li>Email : buketbunga245@gmail.com</li>
            </ul>
        </div>

    </div>

    {{-- GARIS PEMISAH --}}
    <div class="border-t border-white/30 mt-10 pt-4 text-center text-xs text-white/80">
        © {{ date('Y') }} Bouquetde Fleur. All rights reserved.
    </div>

</footer>


<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
{{-- FLOATING BUTTON BANTUAN (KANAN BAWAH) --}}
<a href="{{ route('bantuan') }}"
   class="fixed bottom-6 right-6 z-50
          bg-pink-400 hover:bg-pink-500
          text-white font-semibold
          px-5 py-3 rounded-full
          shadow-lg transition">
    Bantuan
</a>

</body>
</html>
