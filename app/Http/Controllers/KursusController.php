<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Mahasiswa;
class KursusController extends Controller
{
    // Tampilkan halaman kursus
    public function index()
    {
        $kursus = Kursus::all();
        return view('kursus.index',compact('kursus'));
    }
    
    public function show(Kursus $kursus)
    { 
        return view('kursus.show',compact('kursus'));
    }
    
    // Form tambah kursus
    public function create()
    {
        return view('kursus.create');
    }
    // simpan kursus
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kursus' => 'required|unique:kursus',
            'deskripsi' => 'nullable',
        ]);     
        Kursus::create($data);
        return redirect()->route('kursus.index')->with('success','Kursus berhasil ditambahkan');
    }
    // Form edit kursus
    public function edit(Kursus $kursus)
    {
        return view('kursus.edit', compact('kursus'));
    }
    public function update(Request $request, Kursus $kursus)
    {
        $data = $request->validate([
            'nama_kursus' => 'required|unique:kursus,nama_kursus,'.$kursus->id,
            'deskripsi' => 'nullable',
        ]);     
        $kursus->update($data);
        return redirect()->route('kursus.index')->with('success','Kursus berhasil diupdate');
    }
    public function destroy(Kursus $kursus)
    {
        $kursus->delete();
        return redirect()->route('kursus.index')->with('success','Kursus berhasil dihapus');
    }
    public function assignKursus(Request $request, $mahasiswaId)
    {
        $data = $request->validate([
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
        $mahasiswa->kursus()->attach($data['kursus_id']);

        return redirect()->back()->with('success','Kursus berhasil diassign');
    }

}
