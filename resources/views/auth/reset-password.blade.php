<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Sandi</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fdf7f9]">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-between gap-10">

        {{-- KIRI: LOGO --}}
        <div class="flex-1 flex flex-col items-center md:items-start text-center md:text-left">
            <img src="{{ asset('images/logo-buket-new.png') }}"
                 alt="Logo Bouquet"
                 class="w-60 h-60 object-contain mb-8">

            <p class="text-[#b96b86] text-lg font-medium mb-1">
                Berbagai macam model buket.
            </p>
            <p class="text-[#b96b86] text-lg">
                Ayo temukan disini!
            </p>
        </div>

        {{-- KANAN: CARD RESET SANDI --}}
        <div class="flex-1 flex justify-center">
            <div class="w-full max-w-sm bg-white rounded-2xl shadow-[0_8px_30px_rgba(0,0,0,0.06)] px-8 py-9">

                <h2 class="text-2xl font-semibold text-center mb-6 text-[#b96b86]">
                    Reset Sandi
                </h2>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <label class="block mb-2 text-sm font-medium text-gray-700">Password baru</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-2 mb-3 border border-[#e2d4da] rounded-md text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                        required>

                    <label class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-2 mb-5 border border-[#e2d4da] rounded-md text-sm
                               focus:outline-none focus:ring-2 focus:ring-[#d18aa0]"
                        required>

                    <button
                        type="submit"
                        class="w-full py-2.5 rounded-md font-semibold text-sm text-white
                               bg-[#d48fa4] hover:bg-[#c67990] transition-colors">
                        Simpan password
                    </button>

                    <div class="mt-4 text-center text-sm">
                        <a href="{{ route('login') }}" class="text-[#a154ae] hover:text-[#8b3f97] font-semibold">
                            Kembali ke Login
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
