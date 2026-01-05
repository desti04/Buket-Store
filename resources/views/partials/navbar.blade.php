@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;

    $cart = session('cart', []);
    $cartCount = collect($cart)->sum('qty');

    $user = Auth::user();
    $initial = $user ? strtoupper(mb_substr($user->name, 0, 1)) : '';

    // Helper active menu (match path)
    $isActive = function (string $path) {
        return request()->is(ltrim($path, '/')) || request()->is(ltrim($path, '/').'/*');
    };

    $navItems = [
        ['label' => 'Home',        'url' => url('/'),           'active' => $isActive('/')],
        ['label' => 'Buket Bunga', 'url' => url('/buket-bunga'),'active' => $isActive('buket-bunga')],
        ['label' => 'Buket Snack', 'url' => url('/buket-snack'),'active' => $isActive('buket-snack')],
        ['label' => 'Buket Uang',  'url' => url('/buket-uang'), 'active' => $isActive('buket-uang')],
    ];
@endphp

<nav class="w-full bg-pink-200 shadow-md border-b border-pink-300">
    <style>
        /* ===== NAV LINK FX ===== */
        .nav-link{
            position: relative;
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 9999px;
            transition: transform .2s ease, background-color .2s ease, color .2s ease;
        }
        .nav-link:hover{
            transform: translateY(-1px);
        }
        /* underline pill */
        .nav-link::after{
            content: "";
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 4px;
            height: 3px;
            border-radius: 9999px;
            background: rgba(219,39,119,.75); /* pink-600 */
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .25s ease;
        }
        .nav-link:hover::after{
            transform: scaleX(.55);
        }

        /* active state */
        .nav-link.active{
            color: rgba(190, 20, 90, 1); /* pink-800 */
            font-weight: 800;
        }
        .nav-link.active::after{
            transform: scaleX(1);
        }
    </style>

    <div class="w-full flex items-center py-4 px-6">

        {{-- LOGO KIRI --}}
        <div class="flex items-center space-x-2">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo buket new.png') }}"
                     alt="Logo"
                     class="w-12 h-12 rounded-full object-cover shadow">
                <span class="text-pink-700 font-bold text-lg">
                    Bouquetde Fleur
                </span>
            </a>
        </div>

        {{-- MENU TENGAH --}}
        <ul class="hidden md:flex flex-1 justify-center space-x-3 text-pink-700 font-semibold">
            @foreach($navItems as $item)
                <li>
                    <a href="{{ $item['url'] }}"
                       class="nav-link {{ $item['active'] ? 'active' : '' }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- KANAN --}}
        <div class="flex items-center gap-6 ml-auto">

            {{-- Kalau BELUM LOGIN: tampil Login + Register --}}
            @guest
                <a href="{{ route('login') }}"
                   class="px-4 py-2 rounded-full bg-pink-500 text-white font-semibold hover:bg-pink-600 transition">
                    Login
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 rounded-full bg-white/60 text-pink-700 font-semibold hover:bg-white border border-pink-200 transition">
                        Register
                    </a>
                @endif
            @endguest

            {{-- Kalau SUDAH LOGIN: tampil Keranjang + Profil --}}
            @auth
                {{-- ICON KERANJANG --}}
                <a href="{{ route('cart.index') }}" class="relative">
                    <span class="text-2xl">🛒</span>

                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-pink-600 text-white text-xs rounded-full px-1.5">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- PROFILE DROPDOWN --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="flex items-center gap-2 bg-white/60 hover:bg-white px-3 py-1.5 rounded-full shadow-sm border border-pink-200 transition">

                        {{-- AVATAR --}}
                        <div class="w-8 h-8 rounded-full bg-pink-500 flex items-center justify-center text-white font-bold text-sm">
                            {{ $initial }}
                        </div>

                        {{-- NAMA USER --}}
                        <span class="text-sm font-semibold text-pink-700">
                            {{ $user->name }}
                        </span>

                        {{-- CHEVRON --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- MENU DROPDOWN --}}
                    <div x-show="open"
                         x-transition
                         @click.away="open = false"
                         class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-xl py-2 border border-pink-100 z-50">

                        <a href="{{ route('profile.index') }}"
                           class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-pink-50 text-pink-700">
                            <span>👤</span>
                            <span>Profil</span>
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-2 px-4 py-2 text-sm hover:bg-pink-50 text-red-500">
                                <span>🚪</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</nav>
