<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Mahasiswa;
use App\Models\Kursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::with(['mahasiswa', 'kursus'])->get();
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('tugas.create', [
            'mahasiswa' => Mahasiswa::all(),
            'kursus' => Kursus::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required',
            'kursus_id' => 'required',
            'judul' => 'required|string',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
            'nilai' => 'nullable|integer|min:0|max:100',
            'komentar' => 'nullable|string'
        ]);

        // 1 project final per kursus per mahasiswa
        $tugas = Tugas::firstOrNew([
            'mahasiswa_id' => $request->mahasiswa_id,
            'kursus_id' => $request->kursus_id
        ]);

        if ($request->hasFile('file')) {
            if ($tugas->file_path) {
                Storage::disk('public')->delete($tugas->file_path);
            }

            $tugas->file_path = $request->file('file')
                ->store('project_final', 'public');
        }

        $tugas->judul = $request->judul;
        $tugas->nilai = $request->nilai;
        $tugas->komentar = $request->komentar;
        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Project Final berhasil disimpan');
    }

    public function edit(Tugas $tugas)
    {
        return view('tugas.edit', [
            'tugas' => $tugas,
            'mahasiswa' => Mahasiswa::all(),
            'kursus' => Kursus::all()
        ]);
    }

    public function update(Request $request, Tugas $tugas)
    {
        $request->validate([
            'judul' => 'required|string',
            'file' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'nilai' => 'nullable|integer|min:0|max:100',
            'komentar' => 'nullable|string'
        ]);

        if ($request->hasFile('file')) {
            if ($tugas->file_path) {
                Storage::disk('public')->delete($tugas->file_path);
            }

            $tugas->file_path = $request->file('file')
                ->store('project_final', 'public');
        }

        $tugas->judul = $request->judul;
        $tugas->nilai = $request->nilai;
        $tugas->komentar = $request->komentar;
        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Project Final berhasil diupdate');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->file_path) {
            Storage::disk('public')->delete($tugas->file_path);
        }

        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Project Final berhasil dihapus');
    }
}
