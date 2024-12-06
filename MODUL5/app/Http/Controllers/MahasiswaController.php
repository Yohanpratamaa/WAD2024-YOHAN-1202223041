<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('dosen')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('mahasiswa.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required',
            'email' => 'required|email|unique:mahasiswas,email',
            'jurusan' => 'required',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        try {
            Mahasiswa::create($request->all());
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
        } catch (QueryException $exception) {
            if ($exception->getCode() === '23000') { // Code 23000 untuk pelanggaran constraint
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => 'Data dengan NIM atau Email ini sudah ada.']);
            }

            throw $exception;
        }
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $dosens = Dosen::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'dosens'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required',
            'email' => 'required|email|unique:mahasiswas,email',
            'jurusan' => 'required',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        try {
            $mahasiswa->update($request->all());
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
        } catch (QueryException $exception) {
            if ($exception->getCode() === '23000') { // Code 23000 untuk pelanggaran constraint
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => 'Data dengan NIM atau Email ini sudah ada.']);
            }

            throw $exception;
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
