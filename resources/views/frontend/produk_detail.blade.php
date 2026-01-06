@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-2 gap-10">

    {{-- GAMBAR PRODUK --}}
    <div>
        <img
            src="{{ $produk->foto ? asset('images/' . $produk->foto) : asset('images/default.jpg') }}"
            class="w-full h-[350px] object-cover rounded-xl shadow-lg"
            alt="{{ $produk->nama }}">
    </div>

    {{-- DETAIL PRODUK --}}
    <div>
        <h1 class="text-3xl font-bold text-pink-700">
            {{ $produk->nama }}
        </h1>

        <p class="text-2xl font-bold text-pink-600 mt-3">
            Rp {{ number_format($produk->harga, 0, ',', '.') }}
        </p>

        <p class="text-gray-700 mt-4 leading-relaxed">
            {{ $produk->deskripsi }}
        </p>

        <p class="mt-3 text-sm text-gray-500">
            Kategori: {{ $produk->kategori->nama ?? '-' }}
        </p>

        {{-- QTY --}}
        <div class="mt-6">
            <label class="font-semibold">Jumlah</label>
            <input id="qtyInput"
                   type="number"
                   value="1"
                   min="1"
                   class="w-20 border rounded px-2 py-1 ml-2">
        </div>

        {{-- ========================= --}}
        {{-- BUTTON AREA --}}
        {{-- ========================= --}}
        <div class="mt-6 flex gap-4">

            {{-- MASUKKAN KE KERANJANG --}}
            <form action="{{ route('cart.add.detail', $produk->id) }}" method="POST">
                @csrf
                <input type="hidden" name="qty" id="cartQty">

                <button type="submit"
                    onclick="document.getElementById('cartQty').value =
                             document.getElementById('qtyInput').value"
                    class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600">
                    🛒 Masukkan Keranjang
                </button>
            </form>

            {{-- PESAN SEKARANG --}}
            <form action="{{ route('produk.pesanSekarang', $produk->id) }}" method="POST">
                @csrf

                <button type="submit"
                    class="bg-pink-500 text-white px-6 py-2 rounded-lg hover:bg-pink-600">
                    ⚡ Pesan Sekarang
                </button>
            </form>

        </div>

    </div>

</div>

@endsection
