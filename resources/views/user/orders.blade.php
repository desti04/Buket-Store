@extends('layouts.app')

@section('content')

<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Pesanan Saya</h1>

    @if($pesanan->isEmpty())
        <p class="text-gray-500">Belum ada pesanan.</p>
    @else
        <div class="space-y-4">

            @foreach($pesanan as $p)
                <div class="bg-white shadow rounded-lg p-4 flex justify-between">

                    {{-- FOTO PRODUK --}}
                    <div class="flex items-center gap-4">
                        @if($p->image)
                            <img src="{{ asset('images/' . $p->image) }}" 
                                 class="w-20 h-20 object-cover rounded-lg shadow">
                        @else
                            <div class="w-20 h-20 bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-gray-500 text-sm">No Image</span>
                            </div>
                        @endif

                        {{-- DETAIL PRODUK --}}
                        <div>
                            <p class="font-bold text-lg">{{ $p->produk }}</p>
                            <p>Jumlah: {{ $p->jumlah }}</p>
                            <p>Total: Rp {{ number_format($p->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="flex items-center">
                        <span class="px-3 py-1 rounded text-white
                            @if($p->status == 'pending') bg-yellow-500
                            @elseif($p->status == 'selesai') bg-green-600
                            @else bg-red-600 @endif">
                            {{ ucfirst($p->status) }}
                        </span>
                    </div>

                </div>
            @endforeach

        </div>
    @endif

</div>

@endsection
