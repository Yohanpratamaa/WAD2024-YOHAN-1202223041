@extends('layout.app')

@section('title', 'Tambah Dosen')

@section('content')
<h1>Tambah Dosen</h1>
@if($errors->has('message'))
    <div class="alert alert-danger">
        {{ $errors->first('message') }}
    </div>
@endif

<form action="{{ route('dosen.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Kode Dosen</label>
        <input type="text" name="kode_dosen" class="form-control" value="{{ old('kode_dosen') }}" required>
        @error('kode_dosen')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label>Nama Dosen</label>
        <input type="text" name="nama_dosen" class="form-control" value="{{ old('nama_dosen') }}" required>
        @error('nama_dosen')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label>NIP</label>
        <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required>
        @error('nip')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="mb-3">
        <label>No Telepon</label>
        <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}">
        @error('no_telepon')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection