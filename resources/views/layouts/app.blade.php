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
/*FOOTER LOGO*/
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

/* SCROLL REVEAL (TIMBUL) */
.reveal-on-scroll{
    opacity: 0;
    transform: translateY(30px) scale(0.97);
    filter: blur(3px);
    transition:
        opacity 700ms ease,
        transform 700ms cubic-bezier(.2,.8,.2,1),
        filter 700ms ease;
    transition-delay: var(--d, 0ms);
    will-change: opacity, transform, filter;
}

.reveal-on-scroll.is-visible{
    opacity: 1;
    transform: translateY(0) scale(1);
    filter: blur(0);
}

/* FLOATING BUTTON (BANTUAN) SIMPLE ANIMATION */
@keyframes helpFloat {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); } /* simple naik-turun */
}

.help-float {
    animation: helpFloat 2.8s ease-in-out infinite;
    will-change: transform;
}
.help-float:hover {
    animation-play-state: paused; /* hover berhenti biar nggak norak */
}
    </style>
</head>

<body class="bg-white">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 shadow-sm bg-pink-100">
        @includeIf('partials.navbar')
    </header>

    <!-- MAIN CONTENT -->
    <main class="min-h-screen">
        @yield('content')
    </main>

<!-- FOOTER -->
<footer class="bg-pink-300 pt-14 pb-6 mt-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

        {{-- KOLOM 1 : LOGO & DESKRIPSI --}}
        <div>
            <img src="{{ asset('images/logo buket new.png') }}"
                 class="footer-logo w-28 mb-4 rounded-full bg-white p-2 cursor-pointer"
                 alt="Bouquetde Fleur">

            <p class="text-sm leading-relaxed text-pink-800/90">
                Bouquetde Fleur adalah pilihan terbaik untuk berbagai jenis buket
                bunga, snack, dan uang dengan desain elegan dan kualitas terbaik.
            </p>
        </div>

        {{-- KOLOM 2 : INFORMASI --}}
        <div>
            <h3 class="font-semibold text-lg mb-4 text-pink-900">
                Informasi
            </h3>
            <ul class="space-y-2 text-sm text-pink-800">
                <li>
                    <a href="{{ route('tentang.kami') }}"
                       class="hover:text-pink-900 transition">
                        Tentang Kami
                    </a>
                </li>
                <li>
                    <a href="{{ route('syarat.ketentuan') }}"
                       class="hover:text-pink-900 transition">
                        Syarat & Ketentuan
                    </a>
                </li>
                <li>
                    <a href="{{ route('kebijakan.privasi') }}"
                       class="hover:text-pink-900 transition">
                        Kebijakan Privasi
                    </a>
                </li>
            </ul>
        </div>

        {{-- KOLOM 3 : HUBUNGI KAMI --}}
        <div>
            <h3 class="font-semibold text-lg mb-4 text-pink-900">
                Hubungi Kami
            </h3>
            <ul class="space-y-2 text-sm text-pink-800">
                <li>Instagram : @bouquetdefleur17</li>
                <li>Email : buketbunga245@gmail.com</li>
            </ul>
        </div>
    </div>

    {{-- GARIS PEMISAH --}}
    <div class="border-t border-pink-400/60 mt-10 pt-4 text-center text-xs text-pink-900/70">
        © {{ date('Y') }} Bouquetde Fleur. All rights reserved.
    </div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    <!-- SCROLL ANIMATION SCRIPT (REPEAT) -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {

        const markReveal = (nodes, baseDelay = 0, step = 80) => {
            nodes.forEach((el, i) => {
                if (!el || el.classList.contains('reveal-on-scroll')) return;
                el.classList.add('reveal-on-scroll');
                el.style.setProperty('--d', `${baseDelay + (i * step)}ms`);
            });
        };

        // Hero text + tagline + heading kategori
        const textTargets = Array.from(document.querySelectorAll('h1,h2,h3,p,span'))
            .filter(el => {
                const t = (el.textContent || '').trim();
                return (
                    t.includes('Elegance in Every Petal') ||
                    t.includes('Handcrafted with Love') ||
                    t === 'Kategori Pilihan'
                );
            });

        markReveal(textTargets, 0, 120);

        // Card kategori + gambar
        const kategoriHeading = Array.from(document.querySelectorAll('h1,h2,h3'))
            .find(el => (el.textContent || '').trim() === 'Kategori Pilihan');

        if (kategoriHeading) {
            const section = kategoriHeading.closest('section, div') || kategoriHeading.parentElement;

            const cards = section
                ? Array.from(section.querySelectorAll('a,div'))
                    .filter(el => el.querySelector('img'))
                    .slice(0, 24)
                : [];

            markReveal(cards, 120, 90);

            const imgs = section ? Array.from(section.querySelectorAll('img')).slice(0, 24) : [];
            markReveal(imgs, 180, 90);
        }

        // IntersectionObserver REPEAT (scroll naik / turun)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                } else {
                    entry.target.classList.remove('is-visible');
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -10% 0px'
        });

        document.querySelectorAll('.reveal-on-scroll')
            .forEach(el => observer.observe(el));
    });
    </script>

    <!-- FLOATING BUTTON BANTUAN -->
    <a href="{{ route('bantuan') }}"
       class="help-float fixed bottom-6 right-6 z-50
              bg-pink-400 hover:bg-pink-500
              text-white font-semibold
              px-5 py-3 rounded-full
              shadow-lg transition">
        Bantuan
    </a>

</body>
</html>
