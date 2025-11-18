@extends('layouts.admin')

@section('content')

<h3>Daftar Produk</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Form Tambah Produk -->
<div class="card p-3 mb-4">
    <form action="{{ route('admin.produk.tambah') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="col-md-4">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>

            <div class="col-md-4">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>
        </div>

        <button class="btn btn-primary mt-3">Tambah Produk</button>
    </form>
</div>

<!-- Tabel Produk -->
<div class="card p-3">
    <h5>List Produk</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>
            @foreach($produk as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nama }}</td>
                <td>Rp {{ number_format($p->harga) }}</td>
                <td>{{ $p->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
