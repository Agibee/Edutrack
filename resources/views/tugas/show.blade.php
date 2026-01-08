@extends('layouts.index')

@section('title', 'Detail Project Final')
@section('page-title', 'Detail Project Final')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Project Final</h1>
        <a href="{{ route('tugas.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Mahasiswa</label>
            <p class="mt-1 text-sm text-gray-900">{{ $tugas->mahasiswa->nama ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kursus</label>
            <p class="mt-1 text-sm text-gray-900">{{ $tugas->kursus->nama_kursus ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Judul Project</label>
            <p class="mt-1 text-sm text-gray-900">{{ $tugas->judul }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nilai</label>
            <p class="mt-1 text-sm text-gray-900">{{ $tugas->nilai ?? '-' }}</p>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Komentar</label>
            <p class="mt-1 text-sm text-gray-900">{{ $tugas->komentar ?? '-' }}</p>
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">File Project</label>
            @if($tugas->file)
                <p class="mt-1">
                    <a href="{{ Storage::url($tugas->file) }}" target="_blank" class="text-blue-600 underline">
                        Download File
                    </a>
                </p>
            @else
                <p class="mt-1 text-gray-500">-</p>
            @endif
        </div>
    </div>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('tugas.edit', $tugas) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Edit
        </a>
        <form action="{{ route('tugas.destroy', $tugas) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                onclick="return confirm('Apakah Anda yakin ingin menghapus Project Final ini?')">
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection
