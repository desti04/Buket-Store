@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Daftar Pesanan</h2>

    {{-- Alert sukses / error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            List Pesanan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Nama Customer</th>
                        <th>No. HP</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanan as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nama_customer }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                            <td>{{ $p->status }}</td>
                            <td>{{ $p->created_at?->format('d/m/Y H:i') }}</td>
                            <td>
                                {{-- nanti kalau sudah ada route show, baru aktifkan --}}
                                {{-- <a href="{{ route('admin.pesanan.show', $p->id) }}" class="btn btn-sm btn-info">Detail</a> --}}
                                -
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
