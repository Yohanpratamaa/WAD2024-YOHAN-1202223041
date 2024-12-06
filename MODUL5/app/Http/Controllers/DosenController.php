<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_dosen' => 'required|unique:dosens,kode_dosen|max:3',
            'nama_dosen' => 'required',
            'nip' => 'required|unique:dosens,nip',
            'email' => 'required|email|unique:dosens,email',
            'no_telepon' => 'nullable',
        ]);
    
        try {
            Dosen::create($request->all());
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
        } catch (QueryException $exception) {
            if ($exception->getCode() === '23000') {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => 'Data dengan Kode Dosen, NIP, atau Email ini sudah ada.']);
            }
    
            throw $exception;
        }
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'kode_dosen' => 'required|max:3|unique:dosens,kode_dosen,' . $dosen->id,
            'nama_dosen' => 'required',
            'nip' => 'required|unique:dosens,nip,' . $dosen->id,
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'no_telepon' => 'nullable',
        ]);

        try {
            $dosen->update($request->all());
            return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui');
        } catch (QueryException $exception) {
            if ($exception->getCode() === '23000') { // Code 23000 untuk pelanggaran constraint
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['message' => 'Data dengan Kode Dosen, NIP, atau Email ini sudah ada.']);
            }

            throw $exception;
        }
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}
