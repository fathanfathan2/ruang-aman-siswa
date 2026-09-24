<x-app-layout>
    <!-- Header Standar Fathan -->
    <x-slot name="header">
        <div class="flex items-center gap-5">
            <img src="{{ asset('images/logoras.png') }}" 
                 alt="Logo RAS" 
                 class="h-16 w-auto object-contain drop-shadow-md"
                 onerror="this.outerHTML='<div class=\'h-16 w-16 bg-blue-500 rounded-xl flex items-center justify-center text-white font-bold\'>RAS</div>'">
            
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-wide">
                {{ __('Ruang Aman Siswa') }}
            </h2>
        </div>
    </x-slot>


    <!-- Background Utama Dark Mode -->
    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Sambutan (Gradient Cyan-Blue) -->
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-lg p-6 sm:p-10 text-white overflow-hidden relative border border-blue-400/30">
                <div class="relative z-10 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold mb-2 tracking-wide">Selamat datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-blue-100 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Ini adalah Pusat Komando Guru BK. Kelola jadwal konseling siswa, pantau histori kedisiplinan, dan atur master pelanggaran dengan cepat.
                        </p>
                    </div>
                    <!-- Badge Role -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-6 py-3 rounded-xl shadow-inner text-center">
                        <span class="block text-xs text-blue-100 uppercase tracking-wider mb-1">Status Akun</span>
                        <span class="block text-xl font-bold text-white">Guru BK</span>
                    </div>
                </div>
                <!-- Hiasan Background (Lingkaran) -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-blue-300 opacity-20 blur-3xl"></div>
            </div>

            <!-- Main Navigation Cards (Klik-able) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Kartu 1: Sesi Konseling -->
                <a href="{{ route('bk.konseling.index') }}"" class="group bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition-all duration-300 hover:shadow-cyan-500/10 hover:border-cyan-500/50 hover:-translate-y-1 block relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-cyan-500/10 rounded-xl text-cyan-400 border border-cyan-500/20 group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h4 class="text-white text-lg font-bold">Sesi Konseling</h4>
                    </div>
                    <p class="text-slate-400 text-sm mb-4">Kelola jadwal pertemuan tatap muka, persetujuan konseling, dan riwayat siswa.</p>
                    <div class="flex items-center text-cyan-400 text-sm font-semibold group-hover:text-cyan-300">
                        Buka Ruang Konseling <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </a>

                <!-- Kartu 2: Histori Kedisiplinan -->
                <a href="{{ route('catatan-poin.index') }}" class="group bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition-all duration-300 hover:shadow-emerald-500/10 hover:border-emerald-500/50 hover:-translate-y-1 block relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-emerald-500/10 rounded-xl text-emerald-400 border border-emerald-500/20 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="text-white text-lg font-bold">Histori Poin</h4>
                    </div>
                    <p class="text-slate-400 text-sm mb-4">Pantau riwayat poin kedisiplinan dan catat pelanggaran siswa secara *real-time*.</p>
                    <div class="flex items-center text-emerald-400 text-sm font-semibold group-hover:text-emerald-300">
                        Lihat Data Poin <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </a>

                <!-- Kartu 3: Master Pelanggaran -->
                <a href="{{ route('jenis-pelanggaran.index') }}" class="group bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition-all duration-300 hover:shadow-rose-500/10 hover:border-rose-500/50 hover:-translate-y-1 block relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-rose-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-rose-500/10 rounded-xl text-rose-400 border border-rose-500/20 group-hover:bg-rose-500 group-hover:text-white transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h4 class="text-white text-lg font-bold">Master Pelanggaran</h4>
                    </div>
                    <p class="text-slate-400 text-sm mb-4">Kelola daftar aturan sekolah, bobot poin, dan kategori tingkat pelanggaran.</p>
                    <div class="flex items-center text-rose-400 text-sm font-semibold group-hover:text-rose-300">
                        Atur Master Data <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </a>

            </div>

            <!-- Area Aktivitas / Empty State (Slate 800) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-700">
                <h4 class="text-lg font-bold text-white mb-6">Aktivitas Terakhir</h4>
                <div class="flex flex-col items-center justify-center py-12 text-center bg-slate-900/50 rounded-xl border-2 border-dashed border-slate-700">
                    <div class="text-slate-500 mb-3 bg-slate-800 p-4 rounded-full shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-slate-300 font-bold text-lg">Semua Aman Terkendali</p>
                    <p class="text-slate-500 text-sm mt-1 max-w-sm">Belum ada notifikasi atau laporan aktivitas terbaru di sistem hari ini.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>