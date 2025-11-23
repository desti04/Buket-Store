@extends('layouts.admin')

@section('content')
<h3>Daftar Pengguna</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="mb-3">
    <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary">
        + Tambah Pengguna
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Role</th>
            <th>Status</th>
            <th>Total Pesanan</th>
            <th>Total Belanja</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>
                    @if($user->status == 'active')
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                </td>
                <td>{{ $user->pesanan_count ?? 0 }}</td>
                <td>
                    @if(isset($user->total_belanja))
                        Rp {{ number_format($user->total_belanja, 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.pengguna.show', $user->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada pengguna.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
