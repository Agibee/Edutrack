<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\NilaiService;

class NilaiServiceTest extends TestCase
{
    protected $nilaiService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->nilaiService = new NilaiService();
    }

    public function test_hitung_nilai_final_array()
    {
        $nilaiTugas = [80, 90]; // avg 85
        $nilaiUjian = [85, 95]; // avg 90
        $result = $this->nilaiService->hitungNilaiFinal($nilaiTugas, $nilaiUjian, 'array');
        $expected = round(85 * 0.3 + 90 * 0.7, 2); // 25.5 + 63 = 88.5
        $this->assertEquals($expected, $result);
    }

    public function test_hitung_nilai_final_single()
    {
        $result = $this->nilaiService->hitungNilaiFinal(80, 90, 'single');
        $expected = round(80 * 0.3 + 90 * 0.7, 2); // 24 + 63 = 87
        $this->assertEquals($expected, $result);
    }

    public function test_tentukan_grade()
    {
        $this->assertEquals('Excellent', $this->nilaiService->tentukanGrade(95));
        $this->assertEquals('Good', $this->nilaiService->tentukanGrade(85));
        $this->assertEquals('Fail', $this->nilaiService->tentukanGrade(50));
    }

    public function test_validasi_nilai_ujian_valid()
    {
        $nilai = [80, 90, 100];
        $this->assertTrue($this->nilaiService->validasiNilai($nilai, 'ujian'));
    }

    public function test_validasi_nilai_ujian_invalid()
    {
        $nilai = [80, 150]; // >100
        $this->assertFalse($this->nilaiService->validasiNilai($nilai, 'ujian'));
    }

    public function test_validasi_nilai_tugas_valid()
    {
        $this->assertTrue($this->nilaiService->validasiNilai(85, 'tugas'));
    }

    public function test_validasi_nilai_tugas_invalid()
    {
        $this->assertFalse($this->nilaiService->validasiNilai(150, 'tugas'));
    }
}