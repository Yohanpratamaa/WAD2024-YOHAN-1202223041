@extends('layout.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<h1>Daftar Mahasiswa</h1>
<a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Dosen Wali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mahasiswas as $mahasiswa)
        <tr>
            <td>{{ $mahasiswa->nim }}</td>
            <td>{{ $mahasiswa->nama_mahasiswa }}</td>
            <td>{{ $mahasiswa->email }}</td>
            <td>{{ $mahasiswa->jurusan }}</td>
            <td>{{ $mahasiswa->dosen->nama_dosen }}</td>
            <td>
                <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus mahasiswa ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection