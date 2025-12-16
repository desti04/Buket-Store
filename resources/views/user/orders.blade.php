@extends('layouts.app')

@section('title', 'Pesanan Saya')

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
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-semibold leading-tight">Pesanan Saya</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Lihat riwayat pesanan dan status pesanan kamu.
                                </p>
                            </div>

                            <span class="text-sm px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-200 text-gray-600">
                                Total: {{ $pesanan->count() }}
                            </span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-6 sm:p-8">

                        @if($pesanan->isEmpty())
                            <div class="border border-dashed border-gray-200 rounded-xl p-8 text-center">
                                <p class="text-gray-500">Belum ada pesanan.</p>
                                <a href="{{ route('user.dashboard') }}"
                                   class="inline-block mt-4 px-5 py-2.5 rounded-lg bg-[#d08a9b] text-white hover:bg-[#c17889] transition">
                                    Mulai Belanja
                                </a>
                            </div>
                        @else
                            <div class="space-y-4">

                                @foreach($pesanan as $p)
                                    <div class="border border-gray-100 rounded-xl p-4 sm:p-5 bg-white hover:shadow-sm transition">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                            {{-- Kiri: gambar + info --}}
                                            <div class="flex items-center gap-4">
                                                {{-- FOTO PRODUK --}}
                                                @if($p->image)
                                                    <img src="{{ asset('images/' . $p->image) }}"
                                                         alt="Gambar Produk"
                                                         class="w-20 h-20 object-cover rounded-lg border border-gray-100">
                                                @else
                                                    <div class="w-20 h-20 bg-gray-100 flex items-center justify-center rounded-lg border border-gray-200">
                                                        <span class="text-gray-500 text-xs">No Image</span>
                                                    </div>
                                                @endif

                                                {{-- DETAIL --}}
                                                <div class="min-w-0">
                                                    <p class="font-semibold text-base sm:text-lg truncate">
                                                        {{ $p->produk }}
                                                    </p>

                                                    <div class="mt-1 text-sm text-gray-600 space-y-0.5">
                                                        <p>Jumlah: <span class="font-medium text-gray-800">{{ $p->jumlah }}</span></p>
                                                        <p>Total:
                                                            <span class="font-medium text-gray-800">
                                                                Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Kanan: status --}}
                                            <div class="flex items-center justify-between sm:justify-end gap-3">
                                                @php
                                                    $status = strtolower($p->status ?? '');
                                                    $badgeClass = 'bg-gray-500';

                                                    if ($status === 'pending') $badgeClass = 'bg-yellow-500';
                                                    elseif ($status === 'selesai') $badgeClass = 'bg-green-600';
                                                    elseif ($status === 'diproses') $badgeClass = 'bg-blue-600';
                                                    elseif ($status === 'dibatalkan' || $status === 'batal') $badgeClass = 'bg-red-600';
                                                @endphp

                                                <span class="px-3 py-1.5 rounded-lg text-white text-sm {{ $badgeClass }}">
                                                    {{ ucfirst($p->status) }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>
                </div>
            </main>

        </div>
    </div>
</div>
@endsection
