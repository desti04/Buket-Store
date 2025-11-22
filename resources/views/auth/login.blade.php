<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

            <!-- Judul -->
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login Admin</h2>

            <!-- Pesan Error -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Email -->
                <label class="block mb-2 font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                       class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Masukkan email">

                <!-- Password -->
                <label class="block mb-2 font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Masukkan password">

                <!-- Tombol Login -->
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition-all">
                    Login
                </button>
            </form>

        </div>
    </div>

</body>
</html>
