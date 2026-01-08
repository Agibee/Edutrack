<aside class="w-64 bg-slate-800 shadow-md hidden md:flex flex-col h-screen">
    <div class="p-6 text-xl font-bold text-slate-200 border-b border-slate-700 flex items-center gap-2">
        <i class="fas fa-book-open text-emerald-400"></i>
        <span>EduTrack</span>
    </div>

    <nav class="px-4 space-y-2 py-4 flex-1">
        <a href="{{ route('home') }}" class="block px-4 py-2 rounded text-white hover:bg-slate-300 hover:text-slate-900">
            <i class="fas fa-home mr-2"></i> Dashboard
        </a>

        <a href="{{ route('mahasiswa.index') }}" class="block px-4 py-2 rounded text-white hover:bg-gray-300 hover:text-slate-900">
            <i class="fas fa-users mr-2"></i> Mahasiswa
        </a>

        <a href="{{ route('kursus.index') }}" class="block px-4 py-2 rounded text-white hover:bg-gray-300 hover:text-slate-900">
            <i class="fas fa-book mr-2"></i> Kursus
        </a>

        <a href="{{ route('tugas.index') }}" class="block px-4 py-2 rounded text-white hover:bg-gray-300 hover:text-slate-900">
            <i class="fas fa-upload mr-2"></i> Tugas
        </a>

        <a href="{{ route('ujian.index') }}" class="block px-4 py-2 rounded text-white hover:bg-gray-300 hover:text-slate-900">
            <i class="fas fa-upload mr-2"></i> Nilai Ujian
        </a>

        <a href="{{ route('laporan.performa_mahasiswa') }}" class="block px-4 py-2 rounded text-white hover:bg-gray-300 hover:text-slate-900">
            <i class="fas fa-chart-bar mr-2"></i>Peforma Mahasiswa
        </a>
    </nav>

    <div class="mt-auto">
        @include('layouts.footer')
    </div>
</aside>
