@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-2 gap-10">

    {{-- ========================================= --}}
    {{--      IMAGE PRODUK                        --}}
    {{-- ========================================= --}}
    <div>
        <img id="mainImage"
             src="{{ asset('images/' . $produk->foto) }}"
             class="w-[85%] h-[330px] md:h-[360px] object-cover rounded-xl shadow-lg mx-auto transition-all duration-300">
    </div>

    {{-- ========================================= --}}
    {{--             DETAIL PRODUK                 --}}
    {{-- ========================================= --}}
    <div>
        <h1 class="text-3xl font-bold text-pink-700">
            {{ $produk->nama }}
        </h1>

        <p class="text-2xl font-bold text-pink-600 mt-3">
            Rp {{ number_format($produk->harga) }}
        </p>

        <p class="text-gray-700 mt-4 leading-relaxed">
            {{ $produk->deskripsi }}
        </p>

        {{-- ========================================= --}}
        {{--            QTY SELECTOR                 --}}
        {{-- ========================================= --}}
        <div class="mt-6">
            <p class="font-semibold text-gray-700 mb-2">Jumlah</p>

            <div class="flex items-center gap-4">

                <button onclick="updateQty(-1)"
                        class="w-8 h-8 flex items-center justify-center bg-pink-100 
                               text-pink-700 rounded-md text-xl font-bold hover:bg-pink-200">
                    −
                </button>

                <input id="qtyInput" type="text" value="1"
                       class="w-12 text-center border rounded-md py-1 font-semibold text-gray-700">

                <button onclick="updateQty(1)"
                        class="w-8 h-8 flex items-center justify-center bg-pink-100 
                               text-pink-700 rounded-md text-xl font-bold hover:bg-pink-200">
                    +
                </button>

            </div>
        </div>

        {{-- ========================================= --}}
        {{--            BUTTON ACTION                --}}
        {{-- ========================================= --}}
        <div class="mt-6 flex gap-4">

            {{-- ADD TO CART --}}
            <form action="{{ route('cart.add.detail') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="qty" id="qty_form">

                <button type="submit"
                        onclick="document.getElementById('qty_form').value = document.getElementById('qtyInput').value"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg shadow">
                    🛒 Masukkan Keranjang
                </button>
            </form>

            {{-- BUY NOW --}}
            <form action="{{ route('checkout.buyNow') }}" method="POST">
                @csrf
                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                <input type="hidden" name="qty" id="buy_qty">

                <button type="submit"
                        onclick="document.getElementById('buy_qty').value = document.getElementById('qtyInput').value"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg shadow">
                    Pesan Sekarang
                </button>
            </form>

        </div>
    </div>
</div>

{{-- ========================================= --}}
{{--      SCRIPT: UPDATE QTY                   --}}
{{-- ========================================= --}}
<script>
    function updateQty(num) {
        let qty = document.getElementById('qtyInput');
        let value = parseInt(qty.value) + num;

        if (value < 1) value = 1;
        qty.value = value;
    }
</script>

@endsection
