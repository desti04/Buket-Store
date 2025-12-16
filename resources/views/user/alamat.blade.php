@extends('layouts.app')

@section('title', 'Alamat Saya')

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
                    <div class="p-6 sm:p-8 border-b bg-gradient-to-r from-[#d08a9b]/15 to-transparent flex items-center justify-between gap-4">
                        <div>
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Alamat Saya</h1>
                            <p class="text-sm text-gray-600 mt-1">
                                Kelola alamat pengiriman yang tersimpan di akun kamu.
                            </p>
                        </div>

                        <a href="{{ route('profile.address.create') }}"
                           class="inline-flex items-center px-4 py-2 rounded-lg bg-[#d08a9b] text-white text-sm font-medium hover:bg-[#c17889] transition">
                            + Tambah Alamat
                        </a>
                    </div>

                    {{-- Body --}}
                    <div class="p-6 sm:p-8">

                        {{-- Flash success --}}
                        @if (session('success'))
                            <div class="p-4 mb-5 rounded-lg bg-green-50 border border-green-200 text-green-700">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- List alamat --}}
                        @forelse ($addresses as $alamat)
                            <div class="border border-gray-200 rounded-xl p-4 sm:p-5 mb-4 flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $alamat->nama_penerima }}
                                            <span class="text-gray-500 text-sm">({{ $alamat->no_hp }})</span>
                                        </p>

                                        @if (!empty($alamat->label))
                                            <p class="text-xs inline-block mt-1 px-2 py-0.5 rounded-full bg-gray-100 text-gray-600">
                                                {{ $alamat->label }}
                                            </p>
                                        @endif
                                    </div>

                                    {{-- Contoh badge alamat utama (opsional, sesuaikan field di DB) --}}
                                    @if (!empty($alamat->is_default) && $alamat->is_default)
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Alamat Utama
                                        </span>
                                    @endif
                                </div>

                                <div class="text-sm text-gray-700 space-y-1">
                                    <p>{{ $alamat->alamat_lengkap }}</p>
                                    <p>
                                        {{ $alamat->kecamatan }},
                                        {{ $alamat->kota }},
                                        {{ $alamat->provinsi }}
                                        {{ $alamat->kode_pos }}
                                    </p>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-dashed border-gray-200 mt-2 pt-3">
                                    {{-- Set sebagai utama (opsional, sesuaikan route & kondisi) --}}
                                    @if (empty($alamat->is_default) || !$alamat->is_default)
                                        <form action="{{ route('profile.address.set-default', $alamat->id ?? 0) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="text-xs sm:text-sm px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                                                Jadikan Alamat Utama
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('profile.address.edit', $alamat->id ?? 0) }}"
                                       class="text-xs sm:text-sm px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('profile.address.destroy', $alamat->id ?? 0) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus alamat ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-xs sm:text-sm px-3 py-1.5 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-500">
                                <p class="mb-3">Belum ada alamat tersimpan.</p>
                                <a href="{{ route('profile.address.create') }}"
                                   class="inline-flex items-center px-4 py-2 rounded-lg bg-[#d08a9b] text-white text-sm font-medium hover:bg-[#c17889] transition">
                                    + Tambah Alamat Pertama
                                </a>
                            </div>
                        @endforelse

                    </div>
                </div>
            </main>

        </div>
    </div>
</div>
@endsection
