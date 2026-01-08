<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Mahasiswa;
use App\Models\Kursus;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $ujian = Ujian::with(['mahasiswa', 'kursus'])->get();
        return view('ujian.index', compact('ujian'));
    }
    public function show(Ujian $ujian)
    {
        return view('ujian.show', compact('ujian'));
    }

    public function create()
    {
        return view('ujian.create', [
            'mahasiswa' => Mahasiswa::all(),
            'kursus' => Kursus::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'kursus_id' => 'required',
            'nama_ujian' => 'required|string',
            'nilai' => 'nullable|integer|min:0|max:100'
        ]);

        Ujian::create($request->all());

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil ditambahkan');
    }

    public function edit(Ujian $ujian)
    {
        return view('ujian.edit', [
            'ujian' => $ujian,
            'mahasiswa' => Mahasiswa::all(),
            'kursus' => Kursus::all()
        ]);
    }

    public function update(Request $request, Ujian $ujian)
    {
        $request->validate([
            'nama_ujian' => 'required|string',
            'nilai' => 'nullable|integer|min:0|max:100'
        ]);

        $ujian->update($request->all());

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diupdate');
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dihapus');
    }
}
