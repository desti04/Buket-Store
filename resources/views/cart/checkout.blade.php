@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="bg-gray-100 py-8">

    <div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">

        {{-- ALAMAT PENGIRIMAN --}}
<div class="mb-6 border-b pb-4">
    <h2 class="text-xl font-bold text-gray-800 mb-3">Alamat Pengiriman</h2>

    @if($alamat)
        <p class="font-semibold text-gray-900">
            {{ $alamat->nama_penerima }} ({{ $alamat->no_hp }})
        </p>

        <p class="text-gray-700">
            {{ $alamat->alamat_lengkap }}
        </p>

        <p class="text-gray-700">
            {{ $alamat->kecamatan }}, {{ $alamat->kota }}, {{ $alamat->provinsi }} {{ $alamat->kode_pos }}
        </p>

        <a href="{{ route('profile.address.index') }}"
           class="text-blue-500 text-sm mt-2 inline-block hover:underline">
            Ubah Alamat
        </a>

    @else
        <p class="text-gray-600">Belum ada alamat tersimpan.</p>

        <a href="{{ route('profile.address.create') }}"
           class="text-pink-600 text-sm font-semibold hover:underline">
            + Tambah Alamat
        </a>
    @endif
</div>


        {{-- PRODUK DIPESAN --}}
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Produk Dipesan</h2>

            <div class="space-y-4">
                @foreach ($cart as $item)
                    <div class="flex justify-between items-start border rounded-lg p-3">

                        {{-- Gambar --}}
                        <div class="flex items-start gap-3">
                            <img src="{{ asset('images/' . $item['image']) }}"
                                 class="w-20 h-20 rounded-lg shadow">

                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ $item['name'] ?? 'Produk' }}
                                </p>

                                <p class="text-gray-500 text-sm">
                                    Harga Satuan: Rp {{ number_format($item['price'], 0, ',', '.') }}
                                </p>

                                <p class="text-gray-500 text-sm">
                                    Jumlah: {{ $item['qty'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Subtotal --}}
                        <div class="text-right font-bold text-gray-900">
                            Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- PESAN --}}
        <div class="mb-6">
            <label class="font-semibold text-gray-800">Catatan Pesanan (Opsional)</label>
            <textarea class="w-full border rounded-lg p-3 mt-2" rows="2"
                      placeholder="Tinggalkan pesan untuk penjual..."></textarea>
        </div>

        {{-- OPSI PENGIRIMAN --}}
        <div class="mb-6 border-b pb-4">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Opsi Pengiriman</h2>

            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                <div>
                    <p class="font-semibold text-gray-800">Pengiriman Reguler</p>
                    <p class="text-gray-500 text-sm">Estimasi tiba: 2 - 4 hari</p>
                </div>

                <p class="font-bold text-gray-900">Rp 14.000</p>
            </div>
        </div>

        {{-- METODE PEMBAYARAN --}}
<div class="mb-6 border-b pb-4">
    <h2 class="text-xl font-bold text-gray-800 mb-3">Metode Pembayaran</h2>

    <div class="space-y-3">

        {{-- COD --}}
        <label class="flex items-center justify-between p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <div>
                <p class="font-semibold text-gray-800">COD (Bayar di Tempat)</p>
                <p class="text-gray-500 text-sm">Bayar ketika pesanan tiba</p>
            </div>
            <input type="radio" name="metode_pembayaran" value="COD" class="w-5 h-5">
        </label>

    </div>
</div>

        {{-- RINGKASAN PEMBAYARAN --}}
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-3">Ringkasan Pembayaran</h2>

            <div class="space-y-2 text-gray-700">
                <div class="flex justify-between">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between">
                    <span>Biaya Pengiriman</span>
                    <span>Rp 14.000</span>
                </div>

                <div class="flex justify-between">
                    <span>Biaya Layanan</span>
                    <span>Rp 2.000</span>
                </div>

                <hr class="my-3">

                <div class="flex justify-between font-bold text-lg text-gray-900">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($total + 14000 + 2000, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        
        {{-- BUTTON --}}
        <div class="text-right">
            <button class="px-6 py-3 bg-pink-600 text-white font-bold rounded-lg hover:bg-pink-700">
                Buat Pesanan
            </button>
        </div>

    </div>
</div>
@endsection
