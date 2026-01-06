@extends('layouts.index')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Mahasiswa</h1>
        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">NIM</label>
            <p class="mt-1 text-sm text-gray-900">{{ $mahasiswa->nim }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <p class="mt-1 text-sm text-gray-900">{{ $mahasiswa->nama }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <p class="mt-1 text-sm text-gray-900">{{ $mahasiswa->email }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Alamat</label>
            <p class="mt-1 text-sm text-gray-900">{{ $mahasiswa->alamat ?: '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <p class="mt-1 text-sm text-gray-900">{{ $mahasiswa->tanggal_lahir ?: '-' }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">No Telepon</label>
            <p class="mt-1 text-sm text-gray-900">{{ $mahasiswa->no_telepon ?: '-' }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
            Edit
        </a>
        <form action="{{ route('mahasiswa.destroy', $mahasiswa) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection