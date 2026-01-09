<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung data
        $jml_Mahasiswa = DB::table('mahasiswa')->count();
        $jml_kursus   = DB::table('kursus')->count();
        $jml_Mahasiswa_Kursus = DB::table('enrollments')->distinct('mahasiswa_id')->count('mahasiswa_id');
        $jml_Mahasiswa_Tidak_Kursus = $jml_Mahasiswa - $jml_Mahasiswa_Kursus;
        
        // Kirim data ke view
        return view('home', compact('jml_Mahasiswa', 'jml_kursus', 'jml_Mahasiswa_Kursus', 'jml_Mahasiswa_Tidak_Kursus'));
    }
}
