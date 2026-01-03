<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::all();
        return view('tugas.index', compact('tugas'));
    }

    public function show(Tugas $tugas)
    {
        return view('tugas.show', compact('tugas'));
    }

    public function create()
    {
        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'tanggal_deadline' => 'nullable|date',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        Tugas::create($data);

        return redirect()->route('tugas.index')->with('success','Tugas berhasil ditambahkan');
    }

    public function edit(Tugas $tugas)
    {
        return view('tugas.edit', compact('tugas'));
    }

    public function update(Request $request, Tugas $tugas)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'tanggal_deadline' => 'nullable|date',
            'kursus_id' => 'required|exists:kursus,id',
        ]);

        $tugas->update($data);

        return redirect()->route('tugas.index')->with('success','Tugas berhasil diupdate');
    }

    public function destroy(Tugas $tugas)
    {
        $tugas->delete();
        return redirect()->route('tugas.index')->with('success','Tugas berhasil dihapus');
    }
}
