<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanNilaiController extends Controller
{
    // Tampilkan halaman laporan nilai
    public function index()
    {
        return view('laporan_nilai.index');
    }
    

}
