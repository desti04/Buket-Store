@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Manajemen Kategori</h2>

    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <div class="card shadow-sm p-3">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td>
                        <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin menghapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada kategori</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
