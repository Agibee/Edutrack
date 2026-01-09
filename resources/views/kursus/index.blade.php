@extends('layouts.index')

@section('title', 'Daftar Kursus')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kursus</h1>
        <a href="{{ route('kursus.create') }}"
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Data Kursus
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-blue-500 text-white sticky top-0 z-10">
                <tr>
                    <th class="px-6 py-3 whitespace-nowrap">No</th>
                    <th class="px-6 py-3 whitespace-nowrap">Nama Kursus</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($kursus as $krs)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $krs->nama_kursus }}</td>

                    <td class="px-6 py-4 max-w-md wrap-break-word">
                        {{ $krs->deskripsi }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('kursus.show', $krs) }}" class="text-indigo-600 mr-2">Lihat</a>
                        <a href="{{ route('kursus.edit', $krs) }}" class="text-blue-600 mr-2">Edit</a>
                        <form action="{{ route('kursus.destroy', $krs) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600"
                                onclick="return confirm('Hapus kursus ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
