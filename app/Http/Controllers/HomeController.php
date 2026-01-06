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

        // Kirim data ke view
        return view('home', compact('jml_Mahasiswa', 'jml_kursus'));
    }
}
