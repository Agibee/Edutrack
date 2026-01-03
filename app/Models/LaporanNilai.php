<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LaporanNilai extends Model
{
    use HasFactory;
    protected $table = 'laporan_nilai';
    protected $fillable = [
        'mahasiswa_id',
        'kursus_id',
        'nilai',
        'keterangan',
    ];

    function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
}
