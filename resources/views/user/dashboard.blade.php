<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-2xl bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-3xl font-bold mb-4 text-gray-800">
                Dashboard Pengguna
            </h2>

            <p class="text-gray-700 text-lg mb-6">
                Selamat datang kembali,
                <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span>!
            </p>

            <div class="flex gap-4">
                <a href="/" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-all">
                    Kembali ke Beranda
                </a>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-all">
                    Logout
                </a>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>

        </div>
    </div>

</body>
</html>