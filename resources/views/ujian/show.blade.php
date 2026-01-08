@extends('layouts.index')

@section('title', 'Detail Ujian')
@section('page-title', 'Detail Ujian')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Ujian</h1>
        <a href="{{ route('ujian.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Mahasiswa</label>
            <p class="mt-1 text-sm text-gray-900">{{ $ujian->mahasiswa->nama ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kursus</label>
            <p class="mt-1 text-sm text-gray-900">{{ $ujian->kursus->nama_kursus ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Ujian</label>
            <p class="mt-1 text-sm text-gray-900">{{ $ujian->nama_ujian }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nilai</label>
            <p class="mt-1 text-sm text-gray-900">{{ is_array($ujian->nilai) ? collect($ujian->nilai)->avg() : $ujian->nilai ?? '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Komentar</label>
            <p class="mt-1 text-sm text-gray-900">{{ is_array($ujian->komentar) ? implode(', ', $ujian->komentar) : $ujian->komentar ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('ujian.edit', $ujian) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
            Edit
        </a>
        <form action="{{ route('ujian.destroy', $ujian) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus ujian ini?')">
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection
