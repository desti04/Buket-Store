<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan - Buket Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-size: 12px;
            background: #fff;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .title h3 {
            margin-bottom: 0;
        }

        .title small {
            color: #555;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body onload="window.print()">

<div class="container mt-4">

    <div class="no-print mb-3">
        <button class="btn btn-secondary btn-sm" onclick="window.close()">Tutup</button>
    </div>

    <div class="title">
        <h3>Laporan Pesanan</h3>
        <small>Buket Admin - {{ now()->format('d-m-Y H:i') }}</small>
    </div>

    <table class="table table-bordered table-sm">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanan as $index => $p)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $p->nama_pemesan }}</td>
                    <td>{{ $p->produk }}</td>
                    <td class="text-center">{{ $p->jumlah }}</td>
                    <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                    <td>COD</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada pesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>
