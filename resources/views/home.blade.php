@extends('layouts.index')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
    <!-- Cards -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-amber-400 p-4 rounded shadow">
            <p class="text-white text-sm">Mahasiswa</p>
            <p class="text-2xl font-bold text-white">{!! $jml_Mahasiswa !!}</p>
        </div>

        <div class="bg-blue-500 p-4 rounded shadow">
            <p class="text-white text-sm">Kursus</p>
            <p class="text-2xl font-bold text-white">{!! $jml_kursus !!}</p>
        </div>
        <div class="bg-green-500 p-4 rounded shadow">
            <p class="text-white text-sm">Mahasiswa Yang Mengikuti Kursus</p>
            <p class="text-2xl font-bold text-white">{!! $jml_Mahasiswa_Kursus !!}</p>
        </div>
        <div class="bg-purple-500 p-4 rounded shadow">
            <p class="text-white text-sm">Mahasiswa Yang tidak Mengikuti Kursus</p>
            <p class="text-2xl font-bold text-white">{!! $jml_Mahasiswa_Tidak_Kursus !!}</p>
        </div>


        
    </div>
</div>
@endsection
