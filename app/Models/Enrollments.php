<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Enrolments extends Model
{
    //
    use HasFactory;
    protected $table = 'enrollments';
    protected $fillable = [
        'mahasiswa_id',
        'kursus_id',
    ];
}
