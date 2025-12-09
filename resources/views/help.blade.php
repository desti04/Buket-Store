@extends('layouts.app')

@section('title', 'Butuh Bantuan')

@section('content')

<div class="flex flex-col items-center justify-center py-20">

    {{-- LOGO DI TENGAH --}}
    <img src="{{ asset('images/logo-buket-new.png') }}" 
         class="w-28 h-auto mb-6 opacity-90">

    {{-- TITLE --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-2 text-center">
        Ngobrol di WhatsApp dengan Admin
    </h1>

    <p class="text-gray-600 mb-8 text-center max-w-xl">
        Hallo! Tim kami siap membantu kapan saja. Silakan hubungi admin melalui WhatsApp.
    </p>

    {{-- CARD --}}
    <div class="bg-white shadow-lg rounded-xl px-10 py-8 text-center border border-gray-200">

        <p class="text-gray-600 text-lg">Nomor Admin:</p>

        <p class="text-2xl font-bold text-pink-700 mb-5">
            +62 821-9576-3564
        </p>

        {{-- PESAN OTOMATIS --}}
        @php
            $pesan = urlencode("Hallo admin, saya butuh bantuan seputar produk.");
        @endphp

        {{-- BUTTON BUKA APLIKASI --}}
        <a href="https://api.whatsapp.com/send?phone=6281261940291&text={{ $pesan }}"
           target="_blank"
           class="block bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-full text-lg shadow-md transition">
            Buka aplikasi
        </a>

        {{-- BUTTON WA WEB --}}
        <a href="https://web.whatsapp.com/send?phone=6281261940291&text={{ $pesan }}"
           target="_blank"
           class="block mt-4 border border-green-600 text-green-600 hover:bg-green-50 px-6 py-3 rounded-full text-lg font-semibold transition">
            Lanjutkan ke WhatsApp Web
        </a>

    </div>

</div>

@endsection
