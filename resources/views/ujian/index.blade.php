@extends('layouts.index')

@section('title', 'Daftar Ujian')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Ujian</h1>
        <a href="{{ route('ujian.create') }}"
           class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
            Tambah Ujian
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-blue-500 text-white sticky top-0 z-10">
                <tr>
                    <th class="px-6 py-3 whitespace-nowrap">No</th>
                    <th class="px-6 py-3 whitespace-nowrap">Mahasiswa</th>
                    <th class="px-6 py-3 whitespace-nowrap">Kursus</th>
                    <th class="px-6 py-3">Nama Ujian</th>
                    <th class="px-6 py-3 whitespace-nowrap">Nilai</th>
                    <th class="px-6 py-3 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($ujian as $u)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $u->mahasiswa->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $u->kursus->nama_kursus }}</td>

                    <td class="px-6 py-4 max-w-sm wrap-break-word">
                        {{ $u->nama_ujian }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ is_array($u->nilai) ? collect($u->nilai)->avg() : ($u->nilai ?? '-') }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('ujian.show', $u) }}" class="text-indigo-600 mr-2">Lihat</a>
                        <a href="{{ route('ujian.edit', $u) }}" class="text-blue-600 mr-2">Edit</a>
                        <form action="{{ route('ujian.destroy', $u) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600"
                                onclick="return confirm('Hapus ujian ini?')">
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
