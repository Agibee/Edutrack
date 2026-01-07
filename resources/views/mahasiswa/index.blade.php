@extends('layouts.index')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Mahasiswa</h1>
        <a href="{{ route('mahasiswa.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Tambah Data Mahasiswa
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-blue-500">
                <tr >
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">NIM</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal Lahir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($mahasiswa as $mhs)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">{{ $loop->iteration}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $mhs->nim }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">{{ $mhs->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $mhs->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $mhs->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $mhs->tanggal_lahir }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $mhs->no_telepon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('mahasiswa.show', $mhs) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                        <a href="{{ route('mahasiswa.edit', $mhs) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mhs) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection