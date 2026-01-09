<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $table = 'enrollments';

    protected $fillable = [
        'mahasiswa_id',
        'kursus_id',
    ];

    // relasi (opsional tapi disarankan)
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }
}
