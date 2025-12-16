<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Bouquetde Fleur</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Fade In Animation */
        .fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#fdebf2] to-[#fff5f8]">

    <div class="min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-center gap-14 fade-in">

            {{-- LEFT SIDE (Logo + Text) --}}
            <div class="flex-1 md:flex-[0.7] flex flex-col items-center md:items-start text-center md:text-left">

                <img src="{{ asset('images/logo buket new.png') }}"
                     alt="Logo Bouquet"
                     class="w-64 h-64 object-contain mb-8 drop-shadow-md">

                <p class="text-[#b96b86] text-xl font-semibold mb-1 tracking-wide">
                    Daftar dan temukan berbagai macam
                </p>

                <p class="text-[#c07a90] text-lg">
                    model buket impianmu disini 💐
                </p>

            </div>

            {{-- RIGHT SIDE (Register Card) --}}
            <div class="flex-1 md:flex-[0.9] flex justify-center w-full">

                <div class="w-full max-w-sm bg-white/80 backdrop-blur-xl rounded-3xl
                            shadow-[0_8px_30px_rgba(0,0,0,0.08)] px-10 py-10 border border-white">

                    <h2 class="text-3xl font-bold text-center mb-8 text-[#b96b86]">
                        Register
                    </h2>

                    {{-- Success Flash --}}
                    @if (session('status'))
                        <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm rounded">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Error Flash --}}
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}" id="register-form">
                        @csrf

                        {{-- NAME --}}
                        <label class="text-sm font-medium text-gray-600">Nama Lengkap</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-3 mb-4 border border-[#e6d5db] rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#e7a5b8]"
                            placeholder="Nama lengkap"
                            value="{{ old('name') }}">

                        {{-- EMAIL --}}
                        <label class="text-sm font-medium text-gray-600">Email</label>
                        <input type="email" name="email" required
                            class="w-full px-4 py-3 mb-4 border border-[#e6d5db] rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#e7a5b8]"
                            placeholder="Email"
                            value="{{ old('email') }}">

                        {{-- PASSWORD --}}
                        <label class="text-sm font-medium text-gray-600">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 mb-1 border border-[#e6d5db] rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#e7a5b8]"
                            placeholder="Password">

                        <p class="text-xs text-gray-500 mb-3">Min. 6 karakter</p>

                        {{-- CONFIRM PASSWORD --}}
                        <label class="text-sm font-medium text-gray-600">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 mb-6 border border-[#e6d5db] rounded-xl text-sm
                                   focus:outline-none focus:ring-2 focus:ring-[#e7a5b8]"
                            placeholder="Konfirmasi password">

                        {{-- REGISTER BUTTON --}}
                        <button type="submit" id="btn-register"
                            class="w-full py-3 rounded-xl text-white font-semibold tracking-wide
                                   bg-[#d48fa4] hover:bg-[#c67a8d] transition-all shadow-md hover:shadow-lg
                                   disabled:opacity-60 disabled:cursor-not-allowed">

                            <span id="btn-text">Register</span>
                            <span id="btn-loading" class="hidden">Memproses...</span>
                        </button>

                        {{-- OTP INFO --}}
                        <p class="text-xs text-gray-500 mt-3">
                            Setelah klik <b>Register</b>, kode OTP akan dikirim ke email kamu.
                            Verifikasi email untuk mengaktifkan akun.
                        </p>

                        {{-- LINK LOGIN --}}
                        <div class="mt-5 text-center">
                            <p class="text-sm text-gray-600">
                                Sudah punya akun?
                                <a href="{{ route('login') }}"
                                    class="text-[#b96b86] hover:text-[#a65f75] font-semibold ml-1">
                                    Login
                                </a>
                            </p>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- Prevent double submit --}}
    <script>
        const form = document.getElementById('register-form');
        const btn = document.getElementById('btn-register');
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
