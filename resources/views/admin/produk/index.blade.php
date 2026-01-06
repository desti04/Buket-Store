@extends('layouts.admin')

@section('content')

<h3>Daftar Produk</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- FORM TAMBAH PRODUK --}}
<div class="card p-3 mb-4">
    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-md-3">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <label>Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan detail produk..."></textarea>
            </div>
        </div>

        <button class="btn btn-primary mt-3">Tambah Produk</button>
    </form>
</div>


{{-- LIST PRODUK --}}
<div class="card p-3">
    <h5>List Produk</h5>

    <table class="table table-bordered mt-3 align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($produk as $p)
            <tr>
                <td>{{ $p->id }}</td>

                {{-- FOTO --}}
                <td style="width: 110px;">
                    @if($p->foto)
                        <img 
                            src="{{ url('images/'.rawurlencode($p->foto)) }}" 
                            width="80" 
                            style="border-radius: 5px; border:1px solid #ddd;"
                            alt="foto produk">
                    @else
                        <span class="badge bg-secondary">No Foto</span>
                    @endif
                </td>

                <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>

                <td>{{ $p->nama }}</td>

                <td style="max-width: 360px;">
                    {{ $p->deskripsi ?? '-' }}
                </td>

                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>

                <td>{{ $p->stok }}</td>

                {{-- AKSI --}}
                <td style="width: 120px;">
                    <a href="{{ route('admin.produk.edit', $p->id) }}"
                       class="btn btn-warning btn-sm mb-1 w-100">
                        Edit
                    </a>

                    <form action="{{ route('admin.produk.destroy', $p->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                class="btn btn-danger btn-sm w-100">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
