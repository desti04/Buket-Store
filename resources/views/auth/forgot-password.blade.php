<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi | Bouquetde Fleur</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Fade animation */
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

        {{-- LEFT SIDE LOGO --}}
        <div class="flex-1 md:flex-[0.7] flex flex-col items-center md:items-start 
                    text-center md:text-left">

            <img src="{{ asset('images/logo buket new.png') }}"
                 alt="Logo Bouquet"
                 class="w-64 h-64 object-contain mb-8 drop-shadow-md">

            <p class="text-[#b96b86] text-xl font-semibold mb-1 tracking-wide">
                Lupa sandi? Jangan khawatir 💐
            </p>

            <p class="text-[#c07a90] text-lg">
                Kami akan membantu reset kata sandimu.
            </p>
        </div>

        {{-- RIGHT SIDE CARD --}}
        <div class="flex-1 md:flex-[0.9] flex justify-center w-full">

            <div class="w-full max-w-sm bg-white/80 backdrop-blur-xl rounded-3xl
                        shadow-[0_8px_30px_rgba(0,0,0,0.08)] px-10 py-10 border border-white">

                <h2 class="text-3xl font-bold text-center mb-8 text-[#b96b86]">
                    Lupa Sandi
                </h2>

                {{-- SUCCESS MESSAGE --}}
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-600 text-green-700 text-sm rounded">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-600 text-red-700 text-sm rounded">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <label class="text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" required
                           class="w-full px-4 py-3 mb-5 border border-[#e6d5db] rounded-xl text-sm
                                  focus:outline-none focus:ring-2 focus:ring-[#e7a5b8]"
                           placeholder="Masukkan email kamu">

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full py-3 rounded-xl text-white font-semibold tracking-wide
                               bg-[#d48fa4] hover:bg-[#c67a8d] transition-all shadow-md hover:shadow-lg">
                        Kirim Link Reset
                    </button>

                    {{-- BACK TO LOGIN --}}
                    <div class="mt-5 text-center">
                        <p class="text-sm text-gray-600">
                            Kembali ke
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

</body>
</html>
