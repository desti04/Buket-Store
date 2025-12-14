@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-pink-50 flex items-center justify-center px-4">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">

        {{-- Judul --}}
        <h2 class="text-center text-2xl font-bold text-pink-500 mb-6">
            Form Bantuan Pelanggan
        </h2>

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-pink-100 text-pink-700 px-4 py-3 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('bantuan.store') }}" class="space-y-4">
            @csrf

            {{-- Username --}}
            <input
                type="text"
                name="username"
                placeholder="Username Anda"
                required
                class="w-full rounded-xl bg-pink-100 border border-pink-200 px-4 py-3
                       focus:outline-none focus:ring-2 focus:ring-pink-300"
            >

            {{-- WhatsApp --}}
            <input
                type="text"
                name="whatsapp"
                placeholder="Nomor WhatsApp Anda (cth: 08123456789)"
                required
                class="w-full rounded-xl bg-pink-100 border border-pink-200 px-4 py-3
                       focus:outline-none focus:ring-2 focus:ring-pink-300"
            >

            {{-- Jenis Masalah --}}
            <select
                name="jenis_masalah"
                required
                class="w-full rounded-xl bg-pink-100 border border-pink-200 px-4 py-3
                       focus:outline-none focus:ring-2 focus:ring-pink-300 text-pink-600"
            >
                <option value="">Pilih Jenis Masalah</option>
                <option value="Pesanan Belum Diproses">Pesanan Belum Diproses</option>
                <option value="Produk Tidak Sesuai">Produk Tidak Sesuai</option>
                <option value="Masalah Pengiriman">Masalah Pengiriman</option>
                <option value="Pembayaran">Masalah Pembayaran</option>
                <option value="Lainnya">Lainnya</option>
            </select>

            {{-- Pesan --}}
            <textarea
                name="pesan"
                rows="4"
                placeholder="Jelaskan Masalah Anda Lebih Detail"
                required
                class="w-full rounded-xl bg-pink-100 border border-pink-200 px-4 py-3
                       focus:outline-none focus:ring-2 focus:ring-pink-300"
            ></textarea>

            {{-- Tombol --}}
            <button
                type="submit"
                class="w-full bg-pink-400 hover:bg-pink-500 text-white font-semibold
                       py-3 rounded-xl transition duration-200"
            >
                Kirim Pesan Bantuan
            </button>
        </form>
    </div>
</div>
@endsection
