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

    <!-- FOOTER -->
<footer class="bg-pink-300 text-white mt-20 pt-12 pb-4">

    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- ABOUT -->
        <div>
            <h3 class="font-bold text-lg mb-3">About Us</h3>
            <p class="text-sm text-white/90 leading-relaxed">
                Bouquetde Fleur adalah Website buket yang menyediakan berbagai macam
                jenis dan bentuk buket yang menarik dan pastinya kualitas terjamin.
            </p>
        </div>

        <!-- QUICK LINKS -->
        <div>
            <h3 class="font-bold text-lg mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm text-white/90">
                <li><a href="/user/dashboard" class="hover:text-white">Home</a></li>
                <li><a href="/buket-bunga" class="hover:text-white">Products</a></li>
                <li><a href="#" class="hover:text-white">Services</a></li>
                <li><a href="#" class="hover:text-white">Contact Us</a></li>
            </ul>
        </div>

        <!-- FOLLOW US -->
        <div>
            <h3 class="font-bold text-lg mb-3">Follow Us</h3>

            <div class="flex gap-4 text-3xl">

                <!-- Instagram -->
                <a href="#" class="hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" 
                         fill="currentColor" class="w-7 h-7">
                        <path d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.9.3 2.4.6.6.3 1 .6 1.5 1.1.5.5.8.9 1.1 1.5.3.5.5 1.2.6 2.4.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.9-.6 2.4-.3.6-.6 1-1.1 1.5-.5.5-.9.8-1.5 1.1-.5.3-1.2.5-2.4.6-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.9-.3-2.4-.6-.6-.3-1-.6-1.5-1.1-.5-.5-.8-.9-1.1-1.5-.3-.5-.5-1.2-.6-2.4C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.9.6-2.4.3-.6.6-1 1.1-1.5.5-.5.9-.8 1.5-1.1.5-.3 1.2-.5 2.4-.6C8.4 2.2 8.8 2.2 12 2.2zm0 3.8A6 6 0 1 0 12 18a6 6 0 0 0 0-12zm7.3-1.1a1.44 1.44 0 1 1-2.88 0 1.44 1.44 0 0 1 2.88 0z"/>
                    </svg>
                </a>

                <!-- YouTube -->
                <a href="#" class="hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                         fill="currentColor" class="w-8 h-8">
                        <path d="M23.5 6.2s-.2-1.7-.8-2.5c-.8-.9-1.6-1-2-1.1C17.8 2.2 12 2.2 12 2.2h-.1S6.2 2.2 3.3 2.6c-.5.1-1.3.2-2 1.1C.7 4.5.5 6.2.5 6.2S0 8.2 0 10.2v1.6c0 2 .5 4 5 4.4 2.9.4 7.9.4 7.9.4s5 0 7.9-.4c.5-.1 1.3-.2 2-1.1.6-.8.8-2.5.8-2.5s.5-2 .5-4v-1.6c0-2-.5-4-5-4.4zM9.6 14.3V7.7l6.3 3.3-6.3 3.3z"/>
                    </svg>
                </a>

            </div>
        </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="w-full bg-pink-700 text-center text-white text-sm mt-10 py-2">
        © 2024 Bouquetde Fleur. All rights reserved.
    </div>

</footer>

<!-- FLOATING WHATSAPP HELP BUTTON -->
<a href="https://api.whatsapp.com/send?phone=6282195763564&text=Hallo%20admin,%20saya%20butuh%20bantuan%20seputar%20produk"
   class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white w-14 h-14 
          rounded-full shadow-xl flex items-center justify-center text-3xl 
          animate-bounce z-50">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
         class="w-8 h-8" alt="WA">
</a>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
