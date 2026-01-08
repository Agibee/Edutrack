@extends('layouts.index')

@section('title', 'Laporan Performa Mahasiswa')
@section('page-title', 'Laporan Performa Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Performa Mahasiswa</h1>
        <a href="{{ route('laporan.exportPdf') }}" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">
            Cetak PDF
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Kursus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nilai Tugas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nilai Ujian</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nilai Final</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Grade</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @php $no = 1; @endphp
            @foreach($mahasiswas as $mhs)
                @php
                    // Ambil kursus dari tugas dan ujian mahasiswa
                    $kursusDariTugas = $mhs->tugas->pluck('kursus')->unique('id');
                    $kursusDariUjian = $mhs->ujian->pluck('kursus')->unique('id');
                    $kursusMahasiswa = $kursusDariTugas->merge($kursusDariUjian)->unique('id');
                @endphp
                @foreach($kursusMahasiswa as $kursus)
                    @php
                        $tugasMahasiswa = $mhs->tugas->where('kursus_id', $kursus->id);
                        $ujianMahasiswa = $mhs->ujian->where('kursus_id', $kursus->id);
                        $ujian = $ujianMahasiswa->first();

                        $nilai_tugas = $tugasMahasiswa->avg('nilai') ?? 0;
                        $nilai_ujian = $ujianMahasiswa->avg(function($u) {
                            return is_array($u->nilai) ? collect($u->nilai)->avg() : $u->nilai;
                        }) ?? 0;
                        $nilai_final = app(\App\Services\NilaiService::class)->hitungNilaiFinal($nilai_tugas, $nilai_ujian, 'array');

                        // Tentukan grade berdasarkan nilai final
                        $grade = app(\App\Services\NilaiService::class)->tentukanGrade($nilai_final);
                    @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $no++ }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $mhs->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $kursus->nama_kursus }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @forelse($tugasMahasiswa as $t)
                                {{ $t->judul }}: {{ $t->nilai }} <br>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @forelse($ujianMahasiswa as $u)
                                {{ $u->nama_ujian }}: {{ is_array($u->nilai) ? collect($u->nilai)->avg() : $u->nilai }} <br>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $nilai_final }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $grade }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
