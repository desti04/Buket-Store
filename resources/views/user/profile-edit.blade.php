@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="min-h-screen bg-[#f8f6f9]">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            {{-- Sidebar sama seperti di profile.blade.php --}}
            {{-- ... --}}

            {{-- Main --}}
            <main class="md:col-span-8 lg:col-span-9">
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">

                    <div class="p-6 sm:p-8 border-b bg-gradient-to-r from-[#d08a9b]/15 to-transparent flex items-center justify-between gap-3">
                        <div>
                            <h3 class="text-xl font-semibold leading-tight">Edit Profil</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Ubah informasi profil kamu, lalu simpan perubahan.
                            </p>
                        </div>

                        <a href="{{ route('profile.index') }}"
                           class="text-sm px-4 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                            Kembali
                        </a>
                    </div>

                    <div class="p-6 sm:p-8">
                        @if ($errors->any())
                            <div class="p-4 mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5 max-w-xl">
                            @csrf

                            <div>
                                <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="w-full mt-2 p-3 rounded-lg border border-gray-200 focus:border-[#d08a9b] focus:ring-2 focus:ring-[#d08a9b]/30 outline-none"
                                >
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">No HP / WhatsApp</label>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="w-full mt-2 p-3 rounded-lg border border-gray-200 focus:border-[#d08a9b] focus:ring-2 focus:ring-[#d08a9b]/30 outline-none"
                                >
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">Email</label>
                                <input
                                    type="email"
                                    value="{{ $user->email }}"
                                    class="w-full mt-2 p-3 rounded-lg border border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed"
                                    readonly
                                >
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-2">
                                <a href="{{ route('profile.index') }}"
                                   class="px-5 py-2.5 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="px-5 py-2.5 rounded-lg bg-[#d08a9b] text-white hover:bg-[#c17889] transition">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </main>

        </div>
    </div>
</div>
@endsection
