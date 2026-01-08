<!DOCTYPE html>
<html>
<head>
    <title>Laporan Performa Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Performa Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <th>Kursus</th>
                <th>Nilai Tugas</th>
                <th>Nilai Ujian</th>
                <th>Nilai Final</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($mahasiswas as $mhs)
                @php
                    $kursusDariTugas = $mhs->tugas->pluck('kursus')->unique('id');
                    $kursusDariUjian = $mhs->ujian->pluck('kursus')->unique('id');
                    $kursusMahasiswa = $kursusDariTugas->merge($kursusDariUjian)->unique('id');
                @endphp
                @foreach($kursusMahasiswa as $kursus)
                    @php
                        $tugasMahasiswa = $mhs->tugas->where('kursus_id', $kursus->id);
                        $ujianMahasiswa = $mhs->ujian->where('kursus_id', $kursus->id);

                        $nilai_tugas = $tugasMahasiswa->avg('nilai') ?? 0;
                        $nilai_ujian = $ujianMahasiswa->avg(function($u) {
                            return is_array($u->nilai) ? collect($u->nilai)->avg() : $u->nilai;
                        }) ?? 0;
                        $nilai_final = app(\App\Services\NilaiService::class)->hitungNilaiFinal($nilai_tugas, $nilai_ujian, 'array');
                        $grade = app(\App\Services\NilaiService::class)->tentukanGrade($nilai_final);
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $mhs->nama }}</td>
                        <td>{{ $kursus->nama_kursus }}</td>
                        <td>
                            @forelse($tugasMahasiswa as $t)
                                {{ $t->judul }}: {{ $t->nilai }} <br>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td>
                            @forelse($ujianMahasiswa as $u)
                                {{ $u->nama_ujian }}: {{ is_array($u->nilai) ? collect($u->nilai)->avg() : $u->nilai }} <br>
                            @empty
                                -
                            @endforelse
                        </td>
                        <td>{{ $nilai_final }}</td>
                        <td>{{ $grade }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>