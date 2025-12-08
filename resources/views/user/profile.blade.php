@extends('layouts.app')

@section('content')
<div class="min-h-screen flex bg-[#f8f6f9]">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-md p-6 hidden md:block">
        <h2 class="text-xl font-semibold mb-6">Akun Saya</h2>

        <nav class="space-y-3">
            <a href="{{ route('profile.index') }}"
               class="block py-2 px-3 rounded font-medium {{ request()->routeIs('profile.index') ? 'bg-[#d08a9b] text-white' : 'hover:bg-gray-200' }}">
               Profil
            </a>

            <a href="{{ route('profile.address.index') }}"
                class="block py-2 px-3 rounded font-medium {{ request()->routeIs('profile.address.index') ? 'bg-[#d08a9b] text-white' : '' }}">
                Alamat Saya
            </a>

            <a href="{{ route('password.change') }}"
               class="block py-2 px-3 rounded font-medium {{ request()->routeIs('password.change') ? 'bg-[#d08a9b] text-white' : 'hover:bg-gray-200' }}">
               Ubah Password
            </a>

            <a href="{{ route('orders.index') }}"
               class="block py-2 px-3 rounded font-medium {{ request()->routeIs('orders.index') ? 'bg-[#d08a9b] text-white' : 'hover:bg-gray-200' }}">
               Pesanan Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left py-2 px-3 rounded hover:bg-gray-200">Logout</button>
            </form>
        </nav>
    </aside>

    {{-- Isi Halaman --}}
    <main class="flex-1 p-6 md:p-10">
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold mb-6">Profil Saya</h3>

            @if (session('success'))
                <div class="p-3 bg-green-100 border border-green-400 text-green-700 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="space-y-5">

    <div>
        <label class="text-sm font-medium">Nama Lengkap</label>
        <input type="text" name="name" value="{{ auth()->user()->name }}"
               class="w-full mt-2 p-2 rounded border">
    </div>

    <div>
        <label class="text-sm font-medium">Email</label>
        <input type="email" name="email" value="{{ auth()->user()->email }}"
               class="w-full mt-2 p-2 rounded border bg-gray-100 cursor-not-allowed"
               readonly>
    </div>

    <button type="submit"
            class="mt-4 bg-[#d08a9b] text-white px-5 py-2 rounded hover:bg-[#c17889] transition">
        Simpan Perubahan
    </button>
</div>

            </form>
        </div>
    </main>
</div>
@endsection
