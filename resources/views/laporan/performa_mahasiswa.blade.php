@extends('layouts.index')

@section('title', 'Laporan Performa Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Performa Mahasiswa</h1>
        <a href="{{ route('laporan.exportPdf') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">
            Cetak Laporan
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-blue-500 text-white sticky top-0 z-10">
                <tr>
                    <th class="px-6 py-3 whitespace-nowrap">No</th>
                    <th class="px-6 py-3 whitespace-nowrap">Mahasiswa</th>
                    <th class="px-6 py-3 whitespace-nowrap">Kursus</th>
                    <th class="px-6 py-3 whitespace-nowrap">Nilai Tugas</th>
                    <th class="px-6 py-3 whitespace-nowrap">Nilai Ujian</th>
                    <th class="px-6 py-3 whitespace-nowrap">Nilai Final</th>
                    <th class="px-6 py-3 whitespace-nowrap">Grade</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @php $no = 1; @endphp
            @foreach($mahasiswas as $mhs)
                @php
                    $kursusDariTugas = $mhs->tugas->pluck('kursus')->unique('id');
                    $kursusDariUjian = $mhs->ujian->pluck('kursus')->unique('id');
                    $kursusMahasiswa = $kursusDariTugas->merge($kursusDariUjian)->unique('id');
                @endphp

                @foreach($kursusMahasiswa as $kursus)
                    @php
                        $tugas = $mhs->tugas->where('kursus_id', $kursus->id);
                        $ujian = $mhs->ujian->where('kursus_id', $kursus->id);

                        $nilaiTugas = $tugas->avg('nilai') ?? 0;
                        $nilaiUjian = $ujian->avg(fn($u) =>
                            is_array($u->nilai) ? collect($u->nilai)->avg() : $u->nilai
                        ) ?? 0;

                        $nilaiFinal = app(\App\Services\NilaiService::class)
                            ->hitungNilaiFinal($nilaiTugas, $nilaiUjian, 'array');

                        $grade = app(\App\Services\NilaiService::class)
                            ->tentukanGrade($nilaiFinal);
                    @endphp

                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $no++ }}</td>
                        <td class="px-6 py-4">{{ $mhs->nama }}</td>
                        <td class="px-6 py-4">{{ $kursus->nama_kursus }}</td>
                        <td class="px-6 py-4">
                            @forelse($tugas as $t)
                                {{ $t->judul }}: {{ $t->nilai }}<br>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="px-6 py-4">
                            @forelse($ujian as $u)
                                {{ $u->nama_ujian }}:
                                {{ is_array($u->nilai) ? collect($u->nilai)->avg() : $u->nilai }}<br>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $nilaiFinal }}</td>
                        <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $grade }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
