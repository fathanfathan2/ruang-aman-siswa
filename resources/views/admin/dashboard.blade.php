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
            
            <!-- Banner Sambutan Admin (Pure Blue & Cyan) -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl shadow-lg p-6 sm:p-10 text-white overflow-hidden relative border border-blue-400/30">
                <div class="relative z-10 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-bold mb-2 tracking-wide">Selamat datang, Administrator! ⚡</h3>
                        <p class="text-blue-50 text-sm sm:text-base max-w-2xl leading-relaxed">
                            Ini adalah pusat kendali utama sistem Ruang Aman Siswa. Pantau statistik keseluruhan, kelola data pengguna, dan pastikan sistem berjalan lancar.
                        </p>
                    </div>
                    <!-- Badge Role -->
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 px-6 py-3 rounded-xl shadow-inner text-center">
                        <span class="block text-xs text-blue-100 uppercase tracking-wider mb-1">Status Akun</span>
                        <span class="block text-xl font-bold text-white">Administrator</span>
                    </div>
                </div>
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-cyan-300 opacity-20 blur-3xl"></div>
            </div>

            <!-- Quick Stats (Pajangan Statistik Admin - Versi Premium) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Kartu 1: Total Pengguna (Biru) -->
                <div class="group bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition-all duration-300 hover:shadow-blue-500/10 hover:border-blue-500/50 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-blue-500/10 rounded-xl text-blue-400 border border-blue-500/20 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h4 class="text-slate-400 text-sm font-medium">Total Akun Terdaftar</h4>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-white group-hover:text-blue-400 transition-colors">0</p>
                        <span class="text-blue-400 text-xs font-semibold uppercase tracking-wider group-hover:text-blue-300">Pengguna Aktif</span>
                    </div>
                </div>

                <!-- Kartu 2: Log Sistem (Cyan) -->
                <div class="group bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition-all duration-300 hover:shadow-cyan-500/10 hover:border-cyan-500/50 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-cyan-500/10 rounded-xl text-cyan-400 border border-cyan-500/20 group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-slate-400 text-sm font-medium">Total Sesi Konseling</h4>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-white group-hover:text-cyan-400 transition-colors">0</p>
                        <span class="text-cyan-400 text-xs font-semibold uppercase tracking-wider group-hover:text-cyan-300">Sesi Terjadwal</span>
                    </div>
                </div>

                <!-- Kartu 3: Total Pelanggaran (Merah/Rose) -->
                <div class="group bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition-all duration-300 hover:shadow-rose-500/10 hover:border-rose-500/50 hover:-translate-y-1 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-rose-500/5 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-rose-500/10 rounded-xl text-rose-400 border border-rose-500/20 group-hover:bg-rose-500 group-hover:text-white transition-colors">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <h4 class="text-slate-400 text-sm font-medium">Total Pelanggaran</h4>
                    </div>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-white group-hover:text-rose-400 transition-colors">0</p>
                        <span class="text-rose-400 text-xs font-semibold uppercase tracking-wider group-hover:text-rose-300">Data Tercatat</span>
                    </div>
                </div>

            </div>

            <!-- Area Navigasi Fitur Sistem -->
            <h4 class="text-xl font-bold text-white mt-8 mb-4 px-2">Akses Fitur Sistem</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- Link 1: Master Pelanggaran -->
                <a href="{{ route('jenis-pelanggaran.index') }}" class="group p-5 bg-slate-800 border border-slate-700 rounded-2xl hover:border-rose-500 hover:shadow-lg hover:shadow-rose-500/10 transition-all text-left">
                    <div class="w-10 h-10 bg-rose-500/10 text-rose-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-rose-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h5 class="font-bold text-white group-hover:text-rose-400 transition-colors">Master Pelanggaran</h5>
                    <p class="text-xs text-slate-400 mt-1">Kelola data pelanggaran & poin.</p>
                </a>

                <!-- Link 2: Histori Poin -->
                <a href="{{ route('catatan-poin.index') }}" class="group p-5 bg-slate-800 border border-slate-700 rounded-2xl hover:border-emerald-500 hover:shadow-lg hover:shadow-emerald-500/10 transition-all text-left">
                    <div class="w-10 h-10 bg-emerald-500/10 text-emerald-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h5 class="font-bold text-white group-hover:text-emerald-400 transition-colors">Histori Poin</h5>
                    <p class="text-xs text-slate-400 mt-1">Pantau & catat poin siswa.</p>
                </a>

                <!-- Link 3: Sesi Konseling -->
                <a href="#" class="group p-5 bg-slate-800 border border-slate-700 rounded-2xl hover:border-cyan-500 hover:shadow-lg hover:shadow-cyan-500/10 transition-all text-left">
                    <div class="w-10 h-10 bg-cyan-500/10 text-cyan-400 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h5 class="font-bold text-white group-hover:text-cyan-400 transition-colors">Sesi Konseling</h5>
                    <p class="text-xs text-slate-400 mt-1">Akses panel jadwal konseling.</p>
                </a>

                <!-- Link 4: Manajemen Pengguna (Belum Aktif) -->
                <a href="#" class="group p-5 bg-slate-800 border border-slate-700 rounded-2xl hover:border-blue-500 hover:shadow-lg hover:shadow-blue-500/10 transition-all text-left opacity-60 cursor-not-allowed">
                    <div class="w-10 h-10 bg-blue-500/10 text-blue-400 rounded-xl flex items-center justify-center mb-4 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h5 class="font-bold text-white">Kelola User</h5>
                    <p class="text-xs text-slate-400 mt-1">Segera Hadir...</p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>