@extends('layouts.index')

@section('title', 'Edit Project Final')
@section('page-title', 'Edit Project Final')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-xl">

    <form action="{{ route('tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Project</label>
            <input type="text" name="judul" value="{{ $tugas->judul }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label>File Project (Opsional, untuk ganti file)</label>
            @if($tugas->file_path)
                <p class="mb-2"><a href="{{ Storage::url($tugas->file_path) }}" target="_blank" class="text-blue-600 underline">Download File Lama</a></p>
            @endif
            <input type="file" name="file" class="w-full">
        </div>

        <div class="mb-3">
            <label>Nilai</label>
            <input type="number" name="nilai" value="{{ $tugas->nilai }}" class="w-full border p-2 rounded" min="0" max="100">
        </div>

        <div class="mb-3">
            <label>Komentar</label>
            <textarea name="komentar" class="w-full border p-2 rounded">{{ $tugas->komentar }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
