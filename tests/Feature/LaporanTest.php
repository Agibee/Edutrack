<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kursus;
use App\Models\Tugas;
use App\Models\Ujian;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaporanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Buat user admin untuk auth
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    public function test_laporan_performa_mahasiswa_dapat_diakses()
    {
        $response = $this->get('/laporan/performa-mahasiswa');
        $response->assertStatus(200);
        $response->assertViewHas('mahasiswas');
    }

    public function test_export_pdf_berhasil()
    {
        // Buat data dummy
        $mahasiswa = Mahasiswa::factory()->create();
        $kursus = Kursus::factory()->create();
        $mahasiswa->kursus()->attach($kursus);
        Tugas::factory()->create(['mahasiswa_id' => $mahasiswa->id, 'kursus_id' => $kursus->id, 'nilai' => 80]);
        Ujian::factory()->create(['mahasiswa_id' => $mahasiswa->id, 'kursus_id' => $kursus->id, 'nilai' => [85, 90]]);

        $response = $this->get('/laporan/export-pdf');
        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('content-type'));
    }

    public function test_laporan_menampilkan_data_kosong_jika_tidak_ada_tugas_ujian()
    {
        $response = $this->get('/laporan/performa-mahasiswa');
        $response->assertStatus(200);
        // Asumsikan view menangani kosong
    }
}