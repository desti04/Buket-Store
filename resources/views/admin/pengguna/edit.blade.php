@extends('layouts.admin')

@section('content')
<h3>Edit Pengguna</h3>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label>Password (kosongkan jika tidak diganti)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>No Telepon</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
    </div>

    <div class="mb-3">
        <label>Alamat</label>
        <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.pengguna.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
