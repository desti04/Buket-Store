@extends('layouts.admin')

@section('content')

<h3>Selamat Datang, Admin!</h3>
<p>Ini adalah dashboard admin Buket de Fleur.</p>

<div class="row mt-4">

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Total Produk</h5>
            <h3>{{ $totalProduk }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Total Pesanan</h5>
            <h3>{{ $totalPesanan }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Pelanggan</h5>
            <h3>{{ $totalUser }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Pendapatan</h5>
            <h3>
                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
            </h3>
        </div>
    </div>

</div>

@endsection
