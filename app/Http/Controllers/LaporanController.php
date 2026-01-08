<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Services\NilaiService;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class LaporanController extends Controller
{
    protected $nilaiService;

    public function __construct(NilaiService $nilaiService)
    {
        $this->nilaiService = $nilaiService;
    }

    // Method untuk laporan performa mahasiswa
    public function performaMahasiswa()
    {
        // Ambil mahasiswa yang punya tugas atau ujian
        $mahasiswas = Mahasiswa::whereHas('tugas')->orWhereHas('ujian')->with(['kursus', 'tugas', 'ujian'])->get();

        return view('laporan.performa_mahasiswa', compact('mahasiswas'));
    }

    // Method untuk export PDF
    public function exportPdf()
    {
        $mahasiswas = Mahasiswa::whereHas('tugas')->orWhereHas('ujian')->with(['kursus', 'tugas', 'ujian'])->get();

        $pdf = PDF::loadView('laporan.performa_mahasiswa_pdf', compact('mahasiswas'));

        return $pdf->download('laporan_performa_mahasiswa.pdf');
    }
}
