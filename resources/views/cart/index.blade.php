@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-pink-50 py-10">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-6">

        <h1 class="text-2xl font-bold text-pink-700 mb-4">Keranjang Belanja</h1>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (empty($cart))
            <p class="text-gray-500">Keranjang kamu masih kosong, yuk belanja dulu 🌸</p>
        @else
            <div class="space-y-4">
                @foreach ($cart as $item)
                    <div class="flex items-center gap-4 border-b pb-4">

                        {{-- Gambar produk --}}
                        @if($item['image'])
                            <img src="{{ asset('storage/'.$item['image']) }}"
                                 class="w-20 h-20 object-cover rounded-lg" alt="">
                        @else
                            <div class="w-20 h-20 bg-pink-100 rounded-lg flex items-center justify-center text-xs text-pink-500">
                                No Image
                            </div>
                        @endif

                        {{-- Detail --}}
                        <div class="flex-1">
                            <p class="font-semibold text-pink-700">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>

                            {{-- Form ubah qty --}}
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="mt-2 flex items-center gap-2">
                                @csrf
                                <input type="number" name="qty" min="1" value="{{ $item['qty'] }}"
                                       class="w-16 border rounded px-2 py-1 text-center">
                                <button type="submit"
                                        class="text-xs px-3 py-1 bg-pink-500 text-white rounded hover:bg-pink-600">
                                    Update
                                </button>
                            </form>
                        </div>

                        {{-- Hapus --}}
                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                            @csrf
                            <button class="text-sm text-red-500 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Total & tombol --}}
            <div class="mt-6 flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total</p>
                    <p class="text-xl font-bold text-pink-700">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>

                <div class="flex gap-3">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button class="px-4 py-2 rounded-lg border border-pink-400 text-pink-600 text-sm hover:bg-pink-50">
                            Kosongkan Keranjang
                        </button>
                    </form>

                    <button class="px-5 py-2 rounded-lg bg-pink-500 text-white font-semibold hover:bg-pink-600">
                        Checkout
                    </button>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
