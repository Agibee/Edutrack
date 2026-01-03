<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tugas extends Model
{ 
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_deadline',  
        'kursus_id',
    ];
    function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }
    function tugas()
    {
        return $this->hasMany(Tugas::class, 'tugas_id');
    }

}
