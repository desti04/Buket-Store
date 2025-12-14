<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdf7f9]">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-between gap-10">

            {{-- BAGIAN KIRI: Logo + Tagline --}}
            <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left">
                {{-- LOGO (sama seperti di halaman login) --}}
                <img src="{{ asset('images/logo buket new.png') }}"
                     alt="Logo Bouquet"
                     class="w-60 h-60 object-contain mb-8">

                {{-- TEKS DI BAWAH LOGO --}}
                <p class="text-[#b96b86] text-lg font-medium">
                    Daftar dan temukan berbagai macam
                </p>
                <p class="text-[#b96b86] text-lg">
                    model buket di sini!
                </p>
            </div>

            {{-- BAGIAN KANAN: CARD REGISTER --}}
            <div class="flex-1 flex justify-center">
                <div class="w-full max-w-sm bg-white rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.06)] px-8 py-9">

                    {{-- JUDUL --}}
                    <h2 class="text-2xl font-semibold text-center mb-6 text-[#b96b86]">
                        Register
                    </h2>

                    {{-- PESAN SUKSES (kalau ada flash dari backend) --}}
                    @if (session('status'))
                        <div class="mb-4 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 text-sm rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- PESAN ERROR --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    {{-- FORM REGISTER --}}
                    <form method="POST" action="{{ route('register.post') }}" id="register-form">
                        @csrf

                        {{-- NAMA LENGKAP --}}
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               class="w-full px-4 py-2 mb-4 border border-[#e2d4da] rounded-md text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                               placeholder="Nama">

                        {{-- EMAIL --}}
                        <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               class="w-full px-4 py-2 mb-4 border border-[#e2d4da] rounded-md text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                               placeholder="Email">

                        {{-- PASSWORD --}}
                        <label class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                        <input type="password"
                               name="password"
                               required
                               class="w-full px-4 py-2 mb-1 border border-[#e2d4da] rounded-md text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                               placeholder="Password">
                        <p class="text-xs text-gray-500 mb-3">Min. 6 karakter</p>

                        {{-- KONFIRMASI PASSWORD --}}
                        <label class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               required
                               class="w-full px-4 py-2 mb-6 border border-[#e2d4da] rounded-md text-sm
                                      focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                               placeholder="Konfirmasi Password">

                        {{-- TOMBOL REGISTER --}}
                        <button type="submit" id="btn-register"
                                class="w-full py-2.5 rounded-md font-semibold text-sm text-white
                                       bg-[#d48fa4] hover:bg-[#c67990] transition-colors disabled:opacity-60 disabled:cursor-not-allowed">
                            <span class="inline-block" id="btn-text">Register</span>
                            <span class="hidden" id="btn-loading">Memproses...</span>
                        </button>

                        {{-- INFO OTP --}}
                        <p class="text-xs text-gray-500 mt-3">
                            Setelah klik <span class="font-semibold">Register</span>, kode OTP akan dikirim ke email kamu.
                            Verifikasi email untuk mengaktifkan akun.
                        </p>

                        {{-- LINK KE LOGIN (DI TENGAH BAWAH CARD) --}}
                        <div class="mt-4 w-full flex justify-center">
                            <p class="text-sm text-[#b96b86]">
                                Sudah memiliki akun?
                                <a href="{{ route('login') }}"
                                   class="font-semibold text-[#a154ae] hover:text-[#8b3f97] ml-1">
                                    Login
                                </a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- Cegah double submit + state loading --}}
    <script>
        const form = document.getElementById('register-form');
        const btn  = document.getElementById('btn-register');
        const btnt = document.getElementById('btn-text');
        const btnl = document.getElementById('btn-loading');

        form.addEventListener('submit', function () {
            btn.disabled = true;
            btnt.classList.add('hidden');
            btnl.classList.remove('hidden');
        });
    </script>
</body>
</html>
