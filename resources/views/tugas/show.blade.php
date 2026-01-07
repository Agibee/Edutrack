@extends('layouts.index')

@section('title', 'Detail Project Final')
@section('page-title', 'Detail Project Final')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl">

    <p><strong>Mahasiswa:</strong> {{ $tugas->mahasiswa->nama }}</p>
    <p><strong>Kursus:</strong> {{ $tugas->kursus->nama ?? '-' }}</p>
    <p><strong>Judul Project:</strong> {{ $tugas->judul }}</p>
    <p><strong>Nilai:</strong> {{ $tugas->nilai ?? '-' }}</p>
    <p><strong>Komentar:</strong> {{ $tugas->komentar ?? '-' }}</p>
    <p>
        <strong>File:</strong>
        @if($tugas->file_path)
            <a href="{{ Storage::url($tugas->file_path) }}" target="_blank" class="text-blue-600 underline">Download</a>
        @else
            -
        @endif
    </p>

    <div class="mt-4">
        <a href="{{ route('tugas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
        <a href="{{ route('tugas.edit', $tugas) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
    </div>
</div>
@endsection
