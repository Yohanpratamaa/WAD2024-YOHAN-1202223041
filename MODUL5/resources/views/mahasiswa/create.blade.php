@extends('layout.app')

@section('title', 'Tambah Mahasiswa')

@section('content')
<h1>Tambah Mahasiswa</h1>
@if($errors->has('message'))
    <div class="alert alert-danger">
        {{ $errors->first('message') }}
    </div>
@endif

<form action="{{ route('mahasiswa.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>NIM</label>
        <input type="text" name="nim" class="form-control" value="{{ old('nim') }}">
        @error('nim')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div>
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama_mahasiswa" class="form-control" value="{{ old('nama_mahasiswa') }}">
        @error('nama_mahasiswa')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div>
    <div class="mb-3">
        <label>Jurusan</label>
        <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}">
        @error('jurusan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    </div>
    <div class="mb-3">
        <label>Dosen Wali</label>
        <select name="dosen_id" class="form-control">
            @foreach($dosens as $dosen)
            <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection