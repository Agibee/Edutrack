@extends('layouts.index')

@section('title', 'Daftar Project Final')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Project Final</h1>
        <a href="{{ route('tugas.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Project Final
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Mahasiswa</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Kursus</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Judul Project</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nilai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($tugas as $t)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $t->mahasiswa->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $t->kursus->nama ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $t->judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $t->nilai ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('tugas.show', $t) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                        <a href="{{ route('tugas.edit', $t) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                        <form action="{{ route('tugas.destroy', $t) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus project final ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
