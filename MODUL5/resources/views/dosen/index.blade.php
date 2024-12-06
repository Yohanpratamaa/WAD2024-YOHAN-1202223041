@extends('layout.app')

@section('title', 'Daftar Dosen')

@section('content')
<h1>Daftar Dosen</h1>
<a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3">Tambah Dosen</a>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Dosen</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($dosens as $key => $dosen)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $dosen->kode_dosen }}</td>
                <td>{{ $dosen->nama_dosen }}</td>
                <td>{{ $dosen->nip }}</td>
                <td>{{ $dosen->email }}</td>
                <td>{{ $dosen->no_telepon ?? '-' }}</td>
                <td>
                    <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data dosen.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection