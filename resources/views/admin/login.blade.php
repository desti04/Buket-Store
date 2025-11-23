<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login Admin</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <label class="block mb-2 font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                        class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan email">

                <label class="block mb-2 font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                        class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan password">

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition-all">
                    Login
                </button>
                
                <p class="text-center mt-4 text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                        Daftar di sini
                    </a>
                </p>
                </form>

        </div>
    </div>

</body>
</html>