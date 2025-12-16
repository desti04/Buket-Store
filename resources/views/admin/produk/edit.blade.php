@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h3>Edit Produk</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">
        <form action="{{ route('admin.produk.update', $produk->id) }}"
              method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label>Nama Produk</label>
                    <input type="text" name="nama"
                           value="{{ $produk->nama }}"
                           class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori }}"
                                {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga"
                           class="form-control" value="{{ $produk->harga }}" required>
                </div>

                <div class="col-md-2 mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok"
                           class="form-control" value="{{ $produk->stok }}" required>
                </div>

            </div>

            <div class="mb-3">
                <label>Foto Baru (opsional)</label>
                <input type="file" name="foto" class="form-control">

                @if($produk->foto)
                    <p class="mt-2">Foto lama:</p>
                    <img src="{{ asset('images/'.$produk->foto) }}" width="120">
                @endif
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Batal</a>

        </form>
    </div>

</div>
@endsection
