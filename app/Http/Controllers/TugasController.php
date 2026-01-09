<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Mahasiswa;
use App\Models\Kursus;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::with(['mahasiswa', 'kursus'])->get();
        return view('tugas.index', compact('tugas'));
    }

    public function show(Tugas $tugas)
    {
        return view('tugas.show', compact('tugas'));
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
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'kursus_id' => 'required|exists:kursus,id',
            'judul' => 'required|string',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
            'nilai' => 'nullable|integer|min:0|max:100',
            'komentar' => 'nullable|string'
        ]);

        // ✅ AUTO ENROLL (jika belum ada)
        Enrollment::firstOrCreate([
            'mahasiswa_id' => $request->mahasiswa_id,
            'kursus_id' => $request->kursus_id,
        ]);

        // ✅ SIMPAN TUGAS
        $tugas = new Tugas();
        $tugas->mahasiswa_id = $request->mahasiswa_id;
        $tugas->kursus_id = $request->kursus_id;
        $tugas->judul = $request->judul;
        $tugas->nilai = $request->nilai;
        $tugas->komentar = $request->komentar;

        if ($request->hasFile('file')) {
            $tugas->file = $request->file('file')
                ->store('tugas', 'public');
        }

        $tugas->save();

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Tugas berhasil disimpan & mahasiswa otomatis ter-enroll');
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
            if ($tugas->file) {
                Storage::disk('public')->delete($tugas->file);
            }

            $tugas->file = $request->file('file')
                ->store('tugas', 'public');
        }

        $tugas->judul = $request->judul;
        $tugas->nilai = $request->nilai;
        $tugas->komentar = $request->komentar;
        $tugas->save();

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Tugas berhasil diupdate');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->file) {
            Storage::disk('public')->delete($tugas->file);
        }

        $tugas->delete();

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Tugas berhasil dihapus');
    }
}
