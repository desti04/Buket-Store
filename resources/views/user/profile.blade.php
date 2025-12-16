@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-[#f8f6f9]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            {{-- Sidebar --}}
            <aside class="md:col-span-4 lg:col-span-3">
                <div class="bg-white shadow-sm rounded-xl p-6 sticky top-6 hidden md:block">
                    <h2 class="text-lg font-semibold mb-5">Akun Saya</h2>

                    @php
                        $active = "bg-[#d08a9b] text-white";
                        $inactive = "hover:bg-gray-100 text-gray-700";
                        $base = "block py-2.5 px-3 rounded-lg font-medium transition";
                    @endphp

                    <nav class="space-y-2">
                        <a href="{{ route('profile.index') }}"
                           class="{{ $base }} {{ request()->routeIs('profile.index') ? $active : $inactive }}">
                            Profil
                        </a>

                        <a href="{{ route('profile.address.index') }}"
                           class="{{ $base }} {{ request()->routeIs('profile.address.*') ? $active : $inactive }}">
                            Alamat Saya
                        </a>

                        <a href="{{ route('orders.index') }}"
                           class="{{ $base }} {{ request()->routeIs('orders.index') ? $active : $inactive }}">
                            Pesanan Saya
                        </a>

                        <div class="pt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left py-2.5 px-3 rounded-lg font-medium transition hover:bg-red-50 text-red-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </aside>

            {{-- Main --}}
            <main class="md:col-span-8 lg:col-span-9">
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">

                    {{-- Header --}}
                    <div class="p-6 sm:p-8 border-b bg-gradient-to-r from-[#d08a9b]/15 to-transparent">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-[#d08a9b] text-white flex items-center justify-center font-semibold text-lg">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold leading-tight">Profil Saya</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Lihat informasi akun kamu dan kelola password di sini.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-6 sm:p-8 space-y-6">

                        {{-- Flash success umum (misal update profil) --}}
                        @if (session('success'))
                            <div class="p-4 mb-2 rounded-lg bg-green-50 border border-green-200 text-green-700">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Validation Errors (misal dari update password) --}}
                        @if ($errors->any())
                            <div class="p-4 mb-2 rounded-lg bg-red-50 border border-red-200 text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                            {{-- PROFIL (READ ONLY) --}}
                            <div class="border border-gray-100 rounded-xl p-5">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-lg font-semibold">Data Profil</h4>

                                    {{-- tombol edit dengan warna utama --}}
                                    <a href="{{ route('profile.edit') }}"
                                       class="inline-flex items-center px-4 py-1.5 rounded-lg text-sm bg-[#d08a9b] text-white hover:bg-[#c17889] transition">
                                        Edit Profil
                                    </a>
                                </div>

                                <div class="space-y-3">
                                    {{-- Nama --}}
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase">Nama Lengkap</p>
                                        <p class="mt-1 text-sm px-3 py-2 rounded-lg bg-gray-50 border border-gray-100">
                                            {{ auth()->user()->name }}
                                        </p>
                                    </div>

                                    {{-- No HP / WhatsApp --}}
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase">No HP / WhatsApp</p>
                                        <p class="mt-1 text-sm px-3 py-2 rounded-lg bg-gray-50 border border-gray-100">
                                            {{ auth()->user()->phone ?? '-' }}
                                        </p>
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase">Email</p>
                                        <p class="mt-1 text-sm px-3 py-2 rounded-lg bg-gray-50 border border-gray-100">
                                            {{ auth()->user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- KARTU UBAH / LUPA PASSWORD --}}
                            <div class="border border-gray-100 rounded-xl p-5">
                                <h4 class="text-lg font-semibold mb-2">Ubah Password / Lupa Password?</h4>
                                <p class="text-sm text-gray-600 mb-4">
                                    Kamu bisa mengubah password saat ini atau gunakan fitur lupa password jika sudah tidak ingat sama sekali.
                                </p>

                                <div class="flex flex-wrap gap-3">
                                    {{-- tombol buka modal ubah password --}}
                                    <button type="button"
                                            onclick="togglePasswordModal(true)"
                                            class="px-4 py-2 rounded-lg bg-[#d08a9b] text-white text-sm hover:bg-[#c17889] transition">
                                        Ubah Password
                                    </button>

                                    {{-- tombol lupa password: kirim link langsung ke email --}}
                                    <form action="{{ route('password.sendFromProfile') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2 rounded-lg border border-gray-200 text-sm hover:bg-gray-50 transition">
                                            Lupa Password
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </main>

        </div>
    </div>
</div>

{{-- MODAL UBAH PASSWORD --}}
<div id="changePasswordModal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-4">
        <div class="px-5 py-4 border-b flex items-center justify-between">
            <h5 class="font-semibold text-gray-800">Ubah Password</h5>
            <button type="button"
                    onclick="togglePasswordModal(false)"
                    class="text-gray-500 hover:text-gray-700">
                ✕
            </button>
        </div>

        <div class="p-5">
            <form action="{{ route('user.password.update') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-medium text-gray-700">Password Lama</label>
                    <input type="password" name="current_password"
                           class="w-full mt-2 p-3 rounded-lg border border-gray-200 focus:border-[#d08a9b] focus:ring-2 focus:ring-[#d08a9b]/30 outline-none">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="new_password"
                           class="w-full mt-2 p-3 rounded-lg border border-gray-200 focus:border-[#d08a9b] focus:ring-2 focus:ring-[#d08a9b]/30 outline-none">
                    @error('new_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation"
                           class="w-full mt-2 p-3 rounded-lg border border-gray-200 focus:border-[#d08a9b] focus:ring-2 focus:ring-[#d08a9b]/30 outline-none">
                    @error('new_password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button"
                            onclick="togglePasswordModal(false)"
                            class="px-4 py-2 rounded-lg border border-gray-200 text-sm hover:bg-gray-50 transition">
                        Batal
                    </button>

                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-[#d08a9b] text-white text-sm hover:bg-[#c17889] transition">
                        Simpan Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL INFO: LINK RESET PASSWORD TERKIRIM --}}
<div id="resetLinkModal"
     class="fixed inset-0 z-50 {{ session('password_success') ? 'flex' : 'hidden' }} items-center justify-center bg-black/40">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-4">
        <div class="px-5 py-4 border-b flex items-center justify-between">
            <h5 class="font-semibold text-gray-800">Informasi</h5>
            <button type="button"
                    onclick="toggleResetModal(false)"
                    class="text-gray-500 hover:text-gray-700">
                ✕
            </button>
        </div>

        <div class="p-5">
            <p class="text-sm text-gray-700">
                Link penggantian password sudah dikirim ke email anda.
            </p>

            <div class="flex justify-end mt-4">
                <button type="button"
                        onclick="toggleResetModal(false)"
                        class="px-4 py-2 rounded-lg bg-[#d08a9b] text-white text-sm hover:bg-[#c17889] transition">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Script sederhana untuk toggle modal --}}
<script>
    function togglePasswordModal(show) {
        const modal = document.getElementById('changePasswordModal');
        if (!modal) return;
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    }

    function toggleResetModal(show) {
        const modal = document.getElementById('resetLinkModal');
        if (!modal) return;
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    }
</script>
@endsection
