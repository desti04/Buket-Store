@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow-md p-6 rounded-lg mt-10">

    <h2 class="text-xl font-semibold mb-6">Ubah Password</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="text-sm font-medium">Password Lama</label>
            <input type="password" name="current_password"
                   class="w-full mt-2 p-2 border rounded">
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Password Baru</label>
            <input type="password" name="new_password"
                   class="w-full mt-2 p-2 border rounded">
            @error('new_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="text-sm font-medium">Konfirmasi Password</label>
            <input type="password" name="confirm_password"
                   class="w-full mt-2 p-2 border rounded">
            @error('confirm_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button class="bg-[#d08a9b] text-white px-4 py-2 rounded hover:bg-[#c17889] transition">
            Simpan Password
        </button>

    </form>
</div>
@endsection
