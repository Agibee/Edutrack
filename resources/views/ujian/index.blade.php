@extends('layouts.index')

@section('title', 'Daftar Ujian')
@section('page-title', 'Daftar Ujian')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Ujian</h1>
        <a href="{{ route('ujian.create') }}" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
            Tambah Ujian
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white">
        <thead class="bg-blue-500 text-white">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Mahasiswa</th>
                <th class="px-6 py-3">Kursus</th>
                <th class="px-6 py-3">Nama Ujian</th>
                <th class="px-6 py-3">Nilai</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($ujian as $u)
            <tr>
                <td class="px-6 py-2">{{ $loop->iteration }}</td>
                <td class="px-6 py-2">{{ $u->mahasiswa->nama }}</td>
                <td class="px-6 py-2">{{ $u->kursus->nama_kursus }}</td>
                <td class="px-6 py-2">{{ $u->nama_ujian }}</td>
                <td class="px-6 py-2">{{ $u->nilai ?? '-' }}</td>
                <td class="px-6 py-2">
                    <a href="{{ route('ujian.show', $u) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                    <a href="{{ route('ujian.edit', $u) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                    <form action="{{ route('ujian.destroy', $u) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus ujian ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
