<?php

namespace App\Services;

class NilaiService
{
    /**
     * Hitung nilai final dari tugas dan ujian.
     * Menggunakan function overloading via switch berdasarkan tipe input.
     */
    public function hitungNilaiFinal($nilaiTugas, $nilaiUjian, $tipe = 'default')
    {
        switch ($tipe) {
            case 'array':
                // Jika nilai ujian adalah array, hitung avg
                $avgTugas = is_array($nilaiTugas) ? collect($nilaiTugas)->avg() : $nilaiTugas;
                $avgUjian = is_array($nilaiUjian) ? collect($nilaiUjian)->avg() : $nilaiUjian;
                return round($avgTugas * 0.3 + $avgUjian * 0.7, 2);
            case 'single':
                return round($nilaiTugas * 0.3 + $nilaiUjian * 0.7, 2);
            default:
                // Default: asumsikan array
                return $this->hitungNilaiFinal($nilaiTugas, $nilaiUjian, 'array');
        }
    }

    /**
     * Tentukan grade berdasarkan nilai final.
     */
    public function tentukanGrade($nilaiFinal)
    {
        if ($nilaiFinal >= 90) return 'Excellent';
        elseif ($nilaiFinal >= 80) return 'Good';
        elseif ($nilaiFinal >= 70) return 'Satisfactory';
        elseif ($nilaiFinal >= 60) return 'Needs Improvement';
        else return 'Fail';
    }

    /**
     * Validasi input nilai menggunakan loop, conditional, switch.
     */
    public function validasiNilai($nilai, $tipe = 'ujian')
    {
        switch ($tipe) {
            case 'ujian':
                if (!is_array($nilai)) return false;
                foreach ($nilai as $n) {
                    if (!is_numeric($n) || $n < 0 || $n > 100) return false;
                }
                return true;
            case 'tugas':
                return is_numeric($nilai) && $nilai >= 0 && $nilai <= 100;
            default:
                return false;
        }
    }
}