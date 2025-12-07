@extends('layouts.admin')

@section('content')

<h3>Selamat Datang, Admin!</h3>
<p>Ini adalah dashboard admin Buket de Fleur.</p>

<div class="row mt-4">

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Total Produk</h5>
            <h3>120</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Total Pesanan</h5>
            <h3>45</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Pelanggan</h5>
            <h3>80</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow">
            <h5>Pendapatan</h5>
            <h3>Rp 3.200.000</h3>
        </div>
    </div>

</div>

@endsection
