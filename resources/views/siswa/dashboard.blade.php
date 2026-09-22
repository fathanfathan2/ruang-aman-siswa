<x-app-layout>
    <!-- 1. Header Bawaan (Logo Besar Bebas Resolusi) -->
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

    <!-- Memaksa background menjadi gelap (Tema Slate) -->
    <div class="min-h-screen bg-slate-900 py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- 2. Hero Banner (Tetap pakai gradient biru-cyan bawaanmu yang sudah keren) -->
            <div class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 rounded-3xl p-6 sm:p-10 shadow-lg shadow-blue-900/20 overflow-hidden mb-8 border border-blue-500/30">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 right-10 w-40 h-40 bg-cyan-300 opacity-20 rounded-full blur-2xl -mb-10"></div>

                <div class="relative z-10 sm:w-3/4">
                    <span class="inline-block py-1.5 px-4 rounded-full bg-white/10 text-blue-50 text-xs sm:text-sm font-semibold tracking-wide mb-4 backdrop-blur-md border border-white/20 shadow-inner">
                        👋 Halo, {{ explode(' ', Auth::user()->name)[0] }}!
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-bold text-white mb-4 leading-tight">
                        Ada yang ingin kamu ceritakan hari ini?
                    </h2>
                    <p class="text-blue-100 text-sm sm:text-base font-light max-w-xl leading-relaxed">
                        Setiap masalah pasti ada jalan keluarnya. Kami di sini untuk mendengarkan, mendampingi, dan menjaga privasimu.
                    </p>
                </div>
            </div>

            <!-- 3. Main Content Grid (Tema Kartu Slate 800) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">

                <!-- Kolom Kiri: Quick Actions -->
                <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        
                        <!-- Action 1: Buat Laporan (Sekarang jadi Link <a>) -->
                        <a href="#" class="group relative flex flex-col items-start justify-between bg-slate-800 p-6 rounded-3xl shadow-xl border border-slate-700 hover:border-blue-500 hover:-translate-y-1 transition-all duration-300 w-full text-left overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-slate-700/50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            <div class="bg-blue-600 text-white p-3.5 rounded-2xl mb-6 relative z-10 shadow-lg shadow-blue-600/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div class="relative z-10">
                                <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-blue-400 transition-colors">Buat Laporan</h3>
                                <p class="text-xs sm:text-sm text-slate-400 mt-1">Laporkan kendala/pelanggaran secara aman.</p>
                            </div>
                            <div class="mt-6 flex items-center text-sm font-semibold text-blue-400 group-hover:translate-x-2 transition-transform relative z-10">
                                Mulai sekarang <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </a>

                        <!-- Action 2: Sesi Konseling (Sudah Diperbaiki Menjadi Link) -->
                        <a href="{{ route('sesi-konseling.index') }}" class="group relative flex flex-col items-start justify-between bg-slate-800 p-6 rounded-3xl shadow-xl border border-slate-700 hover:border-cyan-400 hover:-translate-y-1 transition-all duration-300 w-full text-left overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-slate-700/50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            <div class="bg-cyan-500 text-white p-3.5 rounded-2xl mb-6 relative z-10 shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="relative z-10">
                                <h3 class="text-lg sm:text-xl font-bold text-white group-hover:text-cyan-400 transition-colors">Sesi Konseling</h3>
                                <p class="text-xs sm:text-sm text-slate-400 mt-1">Atur jadwal tatap muka dengan Guru BK.</p>
                            </div>
                            <div class="mt-6 flex items-center text-sm font-semibold text-cyan-400 group-hover:translate-x-2 transition-transform relative z-10">
                                Jadwalkan <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </a>
                    </div>

                    <!-- Riwayat Section -->
                    <div class="bg-slate-800 rounded-3xl shadow-xl border border-slate-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-slate-700 flex justify-between items-center">
                            <h4 class="text-base font-bold text-white">Aktivitas Terakhir</h4>
                        </div>
                        <div class="p-8 sm:p-12 flex flex-col items-center justify-center text-center">
                            <div class="bg-slate-700/50 p-4 rounded-full mb-4">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="text-base font-semibold text-white">Belum ada aktivitas</p>
                            <p class="text-sm text-slate-400 mt-1 max-w-xs">Laporan atau jadwal konselingmu akan otomatis tampil di sini.</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Status/Statistik Sidebar -->
                <div class="space-y-4 sm:space-y-6">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-slate-700 rounded-3xl p-6 shadow-xl text-white relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 border-4 border-slate-700/50 rounded-full"></div>
                        
                        <div class="flex items-center justify-between mb-6 relative z-10">
                            <span class="text-xs font-medium text-slate-400 uppercase tracking-widest">Akses Pengguna</span>
                            <span class="bg-blue-500/20 text-cyan-400 text-xs font-bold px-3 py-1 rounded-lg border border-blue-500/30">SISWA</span>
                        </div>
                        <div class="flex items-center gap-4 relative z-10">
                            <div class="w-14 h-14 bg-slate-700 rounded-full border-2 border-slate-600 flex items-center justify-center text-xl font-bold shadow-inner shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="font-bold text-lg truncate">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-slate-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-800 p-5 rounded-3xl shadow-xl border border-slate-700 flex flex-col justify-center items-center text-center">
                            <span class="text-3xl font-black text-white">0</span>
                            <span class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider">Laporan</span>
                        </div>
                        <div class="bg-slate-800 p-5 rounded-3xl shadow-xl border border-slate-700 flex flex-col justify-center items-center text-center">
                            <span class="text-3xl font-black text-white">0</span>
                            <span class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider">Konseling</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>