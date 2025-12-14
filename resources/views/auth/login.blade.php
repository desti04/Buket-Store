<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdf7f9]">

    <div class="min-h-screen flex items-center justify-center px-4">
        {{-- WRAPPER UTAMA --}}
        <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-between gap-10">

            {{-- BAGIAN KIRI: LOGO + TEKS --}}
            <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left">
                {{-- LOGO (pakai gambar kamu) --}}
                <img src="{{ asset('images/logo buket new.png') }}"
                     alt="Logo Bouquet"
                     class="w-60 h-60 object-contain mb-8">

                {{-- TEKS DI BAWAH LOGO --}}
                <p class="text-[#b96b86] text-lg font-medium mb-1">
                    Berbagai macam model buket.
                </p>
                <p class="text-[#b96b86] text-lg">
                    Ayo temukan disini!
                </p>
            </div>

            {{-- BAGIAN KANAN: CARD LOGIN --}}
            <div class="flex-1 flex justify-center">
                <div class="w-full max-w-sm bg-white rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.06)] px-8 py-9">

                    {{-- JUDUL LOGIN --}}
                    <h2 class="text-2xl font-semibold text-center mb-6 text-[#b96b86]">
                        Login
                    </h2>

                    {{-- PESAN SUKSES --}}
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- PESAN ERROR --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- FORM LOGIN --}}
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        {{-- EMAIL --}}
                        <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="w-full px-4 py-2 mb-4 border border-[#e2d4da] rounded-md text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                            placeholder="Email">

                        {{-- PASSWORD --}}
                        <label class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="w-full px-4 py-2 mb-2 border border-[#e2d4da] rounded-md text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                            placeholder="Password">

                        {{-- LUPA SANDI --}}
                        <div class="flex justify-end mb-4">
                            <a href="{{ route('password.request') }}"
                               class="text-xs text-[#a154ae] hover:text-[#8b3f97] font-semibold">
                                Lupa sandi?
                            </a>
                        </div>

                        {{-- TOMBOL LOGIN --}}
                        <button
                            type="submit"
                            class="w-full py-2.5 rounded-md font-semibold text-sm text-white
                                   bg-[#d48fa4] hover:bg-[#c67990] transition-colors">
                            Login
                        </button>

                        {{-- TEKS REGISTER (RATA KANAN SEPERTI DI GAMBAR) --}}
                        <div class="mt-3 w-full flex justify-center">
                            <p class="text-sm text-gray-600">
                                Belum memiliki akun?
                                <a href="{{ route('register') }}"
                                   class="text-[#a154ae] hover:text-[#8b3f97] font-semibold ml-1">
                                    Register
                                </a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
