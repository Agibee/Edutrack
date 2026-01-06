<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\MahasiswaController;

// Auth Routes
Route::middleware(['belum_login'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('/', function () {return redirect()->route('login');});
    Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
});

// Protected Routes
Route::middleware('sudah_login')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');    

    // Mahasiswa Routes
    Route::get('mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('mahasiswa/store', [MahasiswaController::class, 'store'])->name ('mahasiswa.store');
    Route::get('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show'])->name('mahasiswa.show');
    Route::get('mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    // Kursus Routes
    Route::get('kursus', [KursusController::class, 'index'])->name('kursus.index');
    Route::get('kursus/create', [KursusController::class, 'create'])->name('kursus.create');
    Route::post('kursus/store', [KursusController::class, 'store'])->name ('kursus.store');
    Route::get('kursus/{kursus}', [KursusController::class, 'show'])->name('kursus.show');
    Route::get('kursus/{kursus}/edit', [KursusController::class, 'edit'])->name('kursus.edit');
    Route::put('kursus/{kursus}', [KursusController::class, 'update'])->name('kursus.update');
    Route::delete('kursus/{kursus}', [KursusController::class, 'destroy'])->name('kursus.destroy');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
