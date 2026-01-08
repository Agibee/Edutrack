<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'nama',
        'email',
        'alamat',
        'tanggal_lahir',
        'no_telepon',
    ];
    

    function kursus()
    {
        return $this->belongsToMany(Kursus::class, 'enrollments', 'mahasiswa_id', 'kursus_id');
    }

    function tugas()
    {
        return $this->hasMany(Tugas::class, 'mahasiswa_id');
    }
    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'mahasiswa_id');
    }

}
