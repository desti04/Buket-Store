@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Pesanan</h4>

        <!-- Tombol Print -->
        <a href="{{ route('pesanan.store') }}" 
           target="_blank" 
           class="btn btn-secondary btn-sm">
            <i class="fa fa-print"></i> Print Laporan
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Customer</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Metode Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pesanan as $p)
                    <tr>
                        <td class="text-center">{{ $p->id }}</td>
                        <td>{{ $p->nama_pemesan }}</td>
                        <td>{{ $p->produk }}</td>
                        <td class="text-center">{{ $p->jumlah }}</td>
                        <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>

                        <td class="text-center">
                            @if ($p->status == 'pending')
                                <span class="badge bg-warning text-dark">pending</span>
                            @elseif ($p->status == 'batal')
                                <span class="badge bg-danger">batal</span>
                            @else
                                <span class="badge bg-success">selesai</span>
                            @endif
                        </td>

                        <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>

                        <td class="text-center">COD</td>

                        <td class="text-center">
                            <form action="{{ route('admin.pesanan.updateStatus', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button name="status" value="selesai" class="btn btn-success btn-sm mb-1">
                                    Terima
                                </button>
                            </form>

                            <form action="{{ route('admin.pesanan.updateStatus', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button name="status" value="batal" class="btn btn-danger btn-sm">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
