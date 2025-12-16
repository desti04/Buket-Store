@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Kategori</h2>

    {{-- Error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada kesalahan pada input kamu:
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ old('nama') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
