<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('layout/app');
// });

use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route untuk Manajemen Dosen
Route::resource('dosen', DosenController::class);

// Route untuk Manajemen Mahasiswa (jika sudah dibuat controller dan view)
Route::resource('mahasiswa', MahasiswaController::class);
