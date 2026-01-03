<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kursus extends Model
{
    //
    use HasFactory;
    protected $table = 'kursus';
    protected $fillable = [
        'kode_kursus',
        'nama_kursus',
        'deskripsi',        
    ];  
    function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'enrollments', 'kursus_id', 'mahasiswa_id');
    }
    function tugas()
    {
        return $this->hasMany(Tugas::class, 'kursus_id');
    }
    function laporanNilai()
    {
        return $this->hasMany(LaporanNilai::class, 'kursus_id');
    }
    
}
