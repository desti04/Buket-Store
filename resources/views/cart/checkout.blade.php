@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="bg-gray-100 py-8">

<form action="#" method="POST">
@csrf

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow p-6">

    {{-- ALAMAT --}}
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-bold mb-3">Alamat Pengiriman</h2>

        @if($alamat)
            <p class="font-semibold">
                {{ $alamat->nama_penerima }} ({{ $alamat->no_hp }})
            </p>
            <p>{{ $alamat->alamat_lengkap }}</p>
        @else
            <p class="text-gray-500">
                Belum ada alamat (fitur akan ditambahkan)
            </p>
        @endif
    </div>

    {{-- PRODUK --}}
    <div class="mb-6">
        <h2 class="text-xl font-bold mb-3">Produk Dipesan</h2>

        @foreach ($cart as $item)
            <div class="flex justify-between border p-3 rounded mb-3">
                <div class="flex gap-3">
                    <img src="{{ asset('images/'.$item['image']) }}"
                         class="w-20 h-20 rounded">

                    <div>
                        <p class="font-semibold">{{ $item['name'] }}</p>
                        <p>Rp {{ number_format($item['price'],0,',','.') }}</p>
                        <p>Qty: {{ $item['qty'] }}</p>
                    </div>
                </div>

                <div class="font-bold">
                    Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}
                </div>
            </div>
        @endforeach
    </div>

    {{-- RINGKASAN --}}
    <div class="mb-6">
        <div class="flex justify-between">
            <span>Subtotal</span>
            <span>Rp {{ number_format($total,0,',','.') }}</span>
        </div>
        <div class="flex justify-between">
            <span>Pengiriman</span>
            <span>Rp 14.000</span>
        </div>
        <div class="flex justify-between">
            <span>Layanan</span>
            <span>Rp 2.000</span>
        </div>

        <hr class="my-3">

        <div class="flex justify-between font-bold text-lg">
            <span>Total</span>
            <span>Rp {{ number_format($total + 16000,0,',','.') }}</span>
        </div>
    </div>

    {{-- BUTTON --}}
    <div class="text-right">
        <button type="submit"
                class="px-6 py-3 bg-pink-600 text-white rounded-lg">
            Buat Pesanan
        </button>
    </div>

</div>
</form>

</div>
@endsection
