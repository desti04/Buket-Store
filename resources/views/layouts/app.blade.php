<!-- resources/views/layouts/app.blade.php -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title>@yield('title', 'Bouquet de Fleur')</title>

    <!-- Tailwind CDN (cepat untuk testing) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Optional: custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>
<body class="bg-white text-gray-800">

    <!-- optional global header -->
    <header class="shadow-sm bg-pink-100">
            {{-- Kamu bisa tempatkan logo / nav global di sini --}}
            @includeIf('partials.navbar')
        </div>
    </header>

    <!-- konten utama -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- footer -->
    <footer class="bg-pink-300 text-center py-5 mt-10 text-white font-medium">
        © {{ date('Y') }} Bouquet de Fleur | Kelompok 4
    </footer>

    <!-- Optional: app JS -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
