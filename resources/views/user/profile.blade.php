@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="bg-pink-50 py-10">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8">

        {{-- Header profil --}}
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 rounded-full bg-pink-500 flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold text-pink-700">Profil Pengguna</h1>
                <p class="text-sm text-gray-500">Kelola data akun kamu di sini</p>
            </div>
        </div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm rounded">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Profil --}}
        <form action="{{ route('user.profile.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none">
            </div>

            {{-- Kalau nanti mau tambah field lain --}}
            {{--
            <div>
                <label class="block mb-1 font-medium text-gray-700">No. Telepon</label>
                <input type="text" name="phone"
                       value="{{ old('phone', $user->phone ?? '') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none">
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Alamat</label>
                <textarea name="address" rows="3"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-pink-400 focus:outline-none">{{ old('address', $user->address ?? '') }}</textarea>
            </div>
            --}}

            <div class="pt-4 flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
