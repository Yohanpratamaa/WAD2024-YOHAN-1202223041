@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>
<p>Selamat datang di Sistem Manajemen Data Dosen dan Mahasiswa Universitas EAD.</p>

<div class="row">
    <!-- Kartu untuk Data Dosen -->
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Manajemen Data Dosen</h5>
                <p class="card-text">Kelola data dosen, seperti menambahkan, mengedit, atau menghapus dosen.</p>
                <p class="card-text" style="font-size: 1.5rem;"><strong>Jumlah Dosen: {{ $jumlahDosen }}</strong></p>
                <a href="{{ route('dosen.index') }}" class="btn btn-primary">Kelola Dosen</a>
            </div>
        </div>
    </div>

    <!-- Kartu untuk Data Mahasiswa -->
    <div class="col-md-6">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Manajemen Data Mahasiswa</h5>
                <p class="card-text">Kelola data mahasiswa, termasuk dosen wali dan informasi akademik lainnya.</p>
                <p class="card-text" style="font-size: 1.5rem;"><strong>Jumlah Mahasiswa: {{ $jumlahMahasiswa }}</strong></p>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary">Kelola Mahasiswa</a>
            </div>
        </div>
    </div>
</div>
@endsection
