<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Daftar Akun Baru</h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <label class="block mb-2 font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan nama lengkap">
                
                <label class="block mb-2 font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan email">

                <label class="block mb-2 font-medium text-gray-700">Password</label>
                <input type="password" name="password" required
                        class="w-full px-4 py-2 mb-4 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan password">
                        
                <label class="block mb-2 font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 mb-6 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Ulangi password">

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition-all">
                    Daftar
                </button>
                
                <p class="text-center mt-4 text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                        Login di sini
                    </a>
                </p>
            </form>

        </div>
    </div>

</body>
</html>