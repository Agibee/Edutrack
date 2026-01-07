<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'mahasiswa_id',
        'kursus_id',
        'judul',
        'file_path',
        'nilai',
        'komentar'
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
