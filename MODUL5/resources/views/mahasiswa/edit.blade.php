@extends('layout.app')

@section('title', 'Edit Mahasiswa')

@section('content')
<h1>Edit Mahasiswa</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nim">NIM</label>
        <input type="text" name="nim" class="form-control" id="nim" value="{{ old('nim', $mahasiswa->nim) }}" required>
    </div>
    <div class="mb-3">
        <label for="nama_mahasiswa">Nama</label>
        <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa) }}" required>
    </div>
    <div class="mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $mahasiswa->email) }}" required>
    </div>
    <div class="mb-3">
        <label for="jurusan">Jurusan</label>
        <input type="text" name="jurusan" class="form-control" id="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" required>
    </div>
    <div class="mb-3">
        <label for="dosen_id">Dosen Wali</label>
        <select name="dosen_id" id="dosen_id" class="form-control" required>
            @foreach($dosens as $dosen)
                <option value="{{ $dosen->id }}" {{ $mahasiswa->dosen_id == $dosen->id ? 'selected' : '' }}>
                    {{ $dosen->nama_dosen }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection