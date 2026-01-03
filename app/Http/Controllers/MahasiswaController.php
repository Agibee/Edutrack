<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{

    // Tampilkan semua mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Simpan mahasiswa
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa',
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable',
        ]);

        Mahasiswa::create($data);

        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa berhasil ditambahkan');
    }

    // Form edit mahasiswa
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Update mahasiswa
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,'.$mahasiswa->id,
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa,email,'.$mahasiswa->id,
            'alamat' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'no_telepon' => 'nullable',
        ]);

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa berhasil diupdate');
    }

    // Hapus mahasiswa
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success','Mahasiswa berhasil dihapus');
    }

    // Assign kursus ke mahasiswa
    public function assignKursus(Request $request, Mahasiswa $mahasiswa)
    {
        $kursusIds = $request->kursus_ids; // array id kursus
        $mahasiswa->kursus()->sync($kursusIds);

        return redirect()->back()->with('success','Kursus berhasil diassign');
    }
}