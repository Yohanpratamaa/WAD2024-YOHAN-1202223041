<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahDosen = Dosen::count();
        $jumlahMahasiswa = Mahasiswa::count();

        return view('dashboard', compact('jumlahDosen', 'jumlahMahasiswa'));
    }
}
