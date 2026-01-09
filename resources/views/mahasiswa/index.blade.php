@extends('layouts.index')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Mahasiswa</h1>
        <a href="{{ route('mahasiswa.create') }}"
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Data Mahasiswa
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
                    <th class="px-6 py-3 whitespace-nowrap">NIM</th>
                    <th class="px-6 py-3 whitespace-nowrap">Nama</th>
                    <th class="px-6 py-3 whitespace-nowrap">Email</th>
                    <th class="px-6 py-3 whitespace-nowrap">Alamat</th>
                    <th class="px-6 py-3 whitespace-nowrap">Tanggal Lahir</th>
                    <th class="px-6 py-3 whitespace-nowrap">No Telepon</th>
                    <th class="px-6 py-3 whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($mahasiswa as $mhs)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4">{{ $mhs->nim }}</td>
                    <td class="px-6 py-4">{{ $mhs->nama }}</td>
                    <td class="px-6 py-4">{{ $mhs->email }}</td>
                    <td class="px-6 py-4 max-w-xs wrap-break-word">{{ $mhs->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->tanggal_lahir }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mhs->no_telepon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('mahasiswa.show', $mhs) }}" class="text-indigo-600 mr-2">Lihat</a>
                        <a href="{{ route('mahasiswa.edit', $mhs) }}" class="text-blue-600 mr-2">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mhs) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600"
                                onclick="return confirm('Hapus mahasiswa ini?')">
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
