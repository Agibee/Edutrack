@extends('layouts.index')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

    <p class="text-gray-600">
        Tailwind sudah aktif 🎉
    </p>

    <div class="mt-6 bg-red-500 text-white text-xl p-4 rounded">
        TAILWIND TEST 🔥
    </div>

    <!-- Cards -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-amber-400 p-4 rounded shadow">
            <p class="text-white text-sm">Mahasiswa</p>
            <p class="text-2xl font-bold text-white">40</p>
        </div>

        <div class="bg-blue-500 p-4 rounded shadow">
            <p class="text-white text-sm">Kursus</p>
            <p class="text-2xl font-bold text-white">12</p>
        </div>

        
    </div>
</div>
@endsection
