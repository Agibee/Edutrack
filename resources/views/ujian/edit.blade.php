@extends('layouts.index')

@section('title', 'Edit Ujian')
@section('page-title', 'Edit Ujian')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl">
    <form action="{{ route('ujian.update', $ujian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Mahasiswa</label>
            <select name="mahasiswa_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach($mahasiswa as $m)
                    <option value="{{ $m->id }}" {{ (old('mahasiswa_id', $ujian->mahasiswa_id) == $m->id) ? 'selected' : '' }}>{{ $m->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kursus</label>
            <select name="kursus_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kursus --</option>
                @foreach($kursus as $k)
                    <option value="{{ $k->id }}" {{ (old('kursus_id', $ujian->kursus_id) == $k->id) ? 'selected' : '' }}>{{ $k->nama_kursus }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Ujian</label>
            <input type="text" name="nama_ujian" value="{{ old('nama_ujian', $ujian->nama_ujian) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>Nilai (Array)</label>
            @if(is_array($ujian->nilai))
                @foreach($ujian->nilai as $index => $n)
                    <input type="number" name="nilai[]" value="{{ old('nilai.' . $index, $n) }}" class="w-full border p-2 rounded mb-2" min="0" max="100" placeholder="Nilai {{ $index + 1 }}">
                @endforeach
            @else
                <input type="number" name="nilai[]" value="{{ old('nilai.0', $ujian->nilai) }}" class="w-full border p-2 rounded" min="0" max="100" placeholder="Nilai 1">
            @endif
        </div>

        <div class="mb-3">
            <label>Komentar (Array)</label>
            @if(is_array($ujian->komentar))
                @foreach($ujian->komentar as $index => $k)
                    <input type="text" name="komentar[]" value="{{ old('komentar.' . $index, $k) }}" class="w-full border p-2 rounded mb-2" placeholder="Komentar {{ $index + 1 }}">
                @endforeach
            @else
                <input type="text" name="komentar[]" value="{{ old('komentar.0') }}" class="w-full border p-2 rounded" placeholder="Komentar 1">
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
