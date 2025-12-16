@extends('layouts.admin')

@section('content')
<h3>Detail Pengguna</h3>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Telepon:</strong> {{ $user->phone ?? '-' }}</p>
        <p><strong>Alamat:</strong> {{ $user->address ?? '-' }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <p><strong>Status:</strong> 
            @if($user->status == 'active')
                <span class="badge bg-success">Aktif</span>
            @else
                <span class="badge bg-secondary">Nonaktif</span>
            @endif
        </p>
        <p><strong>Tanggal Daftar:</strong> {{ $user->created_at->format('d-m-Y H:i') }}</p>
    </div>
</div>

<h5>Riwayat Pesanan</h5>

@if($user->pesanan->isEmpty())
    <p>Belum ada pesanan.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Pesanan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user->pesanan as $p)
                <tr>
                    <td>{{ $p->kode_pesanan ?? $p->id }}</td>
                    <td>Rp {{ number_format($p->total_harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($p->status ?? '-') }}</td>
                    <td>{{ $p->created_at?->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

<a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
