@extends('layouts.index')

@section('title', 'Tambah Project Final')
@section('page-title', 'Tambah Project Final')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl">

    <form action="{{ route('tugas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Mahasiswa</label>
            <select name="mahasiswa_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach($mahasiswa as $m)
                    <option value="{{ $m->id }}" {{ old('mahasiswa_id') == $m->id ? 'selected' : '' }}>{{ $m->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kursus</label>
            <select name="kursus_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kursus --</option>
                @foreach($kursus as $k)
                    <option value="{{ $k->id }}" {{ old('kursus_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kursus }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Nama Tugas</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>File Project</label>
            <input type="file" name="file" class="w-full" required>
        </div>

        <div class="mb-3">
            <label>Nilai </label>
            <input type="number" name="nilai" value="{{ old('nilai') }}" class="w-full border p-2 rounded" min="0" max="100">
        </div>

        <div class="mb-3">
            <label>Komentar</label>
            <textarea name="komentar" class="w-full border p-2 rounded">{{ old('komentar') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
