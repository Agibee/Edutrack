<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujian';

    protected $fillable = [
        'mahasiswa_id',
        'kursus_id',
        'nama_ujian',
        'nilai',
        'komentar'
    ];

    protected $casts = [
        'nilai' => 'array',
        'komentar' => 'array',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}

