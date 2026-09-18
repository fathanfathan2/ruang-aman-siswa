<x-app-layout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- 1. Custom App Header (Logo + Nama Aplikasi) -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="bg-white dark:bg-gray-800 p-2 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 flex-shrink-0">
                        <img src="{{ asset('images/logorasdark.png') }}" alt="Logo Ruang Aman" class="w-10 h-10 sm:w-12 sm:h-12 object-contain" 
                             onerror="this.outerHTML='<div class=\'w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center\'><svg class=\'w-6 h-6 text-blue-600 dark:text-blue-400\' fill=\'currentColor\' viewBox=\'0 0 24 24\'><path d=\'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z\'/></svg></div>'">
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                            Ruang Aman <span class="text-blue-600 dark:text-blue-400">Siswa</span>
                        </h1>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 font-medium mt-0.5">Portal Layanan Bimbingan & Konseling</p>
                    </div>
                </div>
            </div>

            <!-- 2. Hero Banner (Jarak Normal, Bebas Tabrak) -->
            <div class="relative bg-gradient-to-br from-blue-700 via-blue-600 to-sky-500 rounded-3xl p-6 sm:p-10 shadow-xl overflow-hidden mb-8">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 right-10 w-40 h-40 bg-sky-300 opacity-20 rounded-full blur-2xl -mb-10"></div>

                <div class="relative z-10 sm:w-3/4">
                    <span class="inline-block py-1.5 px-4 rounded-full bg-white/20 text-blue-50 text-xs sm:text-sm font-semibold tracking-wide mb-4 backdrop-blur-sm border border-white/30 shadow-inner">
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

            <!-- 3. Main Content Grid (Tanpa Overlap) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">

                <!-- Kolom Kiri: Quick Actions -->
                <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Action 1 -->
                        <button class="group relative flex flex-col items-start justify-between bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-500 hover:-translate-y-1 transition-all duration-300 w-full text-left overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 dark:bg-blue-900/20 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            <div class="bg-blue-600 text-white p-3.5 rounded-2xl mb-6 relative z-10 shadow-lg shadow-blue-600/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div class="relative z-10">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Buat Laporan</h3>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Laporkan kendala/pelanggaran secara aman.</p>
                            </div>
                            <div class="mt-6 flex items-center text-sm font-semibold text-blue-600 dark:text-blue-400 group-hover:translate-x-2 transition-transform relative z-10">
                                Mulai sekarang <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </button>

                        <!-- Action 2 -->
                        <button class="group relative flex flex-col items-start justify-between bg-white dark:bg-gray-800 p-6 rounded-3xl shadow-lg shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 hover:border-sky-300 dark:hover:border-sky-500 hover:-translate-y-1 transition-all duration-300 w-full text-left overflow-hidden">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-sky-50 dark:bg-sky-900/20 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                            <div class="bg-sky-500 text-white p-3.5 rounded-2xl mb-6 relative z-10 shadow-lg shadow-sky-500/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="relative z-10">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800 dark:text-gray-100 group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">Sesi Konseling</h3>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Atur jadwal tatap muka dengan Guru BK.</p>
                            </div>
                            <div class="mt-6 flex items-center text-sm font-semibold text-sky-600 dark:text-sky-400 group-hover:translate-x-2 transition-transform relative z-10">
                                Jadwalkan <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </div>
                        </button>
                    </div>

                    <!-- Riwayat Section -->
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-50 dark:border-gray-700/50 flex justify-between items-center">
                            <h4 class="text-base font-bold text-gray-800 dark:text-gray-100">Aktivitas Terakhir</h4>
                        </div>
                        <div class="p-8 sm:p-12 flex flex-col items-center justify-center text-center">
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-4 rounded-full mb-4">
                                <svg class="w-10 h-10 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Belum ada aktivitas</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-xs">Laporan atau jadwal konselingmu akan otomatis tampil di sini.</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Status/Statistik Sidebar -->
                <div class="space-y-4 sm:space-y-6">
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 dark:from-gray-700 dark:to-gray-800 rounded-3xl p-6 shadow-xl shadow-gray-900/20 text-white relative overflow-hidden">
                        <div class="absolute -right-6 -top-6 w-24 h-24 border-4 border-gray-700/50 rounded-full"></div>
                        
                        <div class="flex items-center justify-between mb-6 relative z-10">
                            <span class="text-xs font-medium text-gray-400 uppercase tracking-widest">Akses Pengguna</span>
                            <span class="bg-blue-500/20 text-blue-300 text-xs font-bold px-3 py-1 rounded-lg border border-blue-500/30">SISWA</span>
                        </div>
                        <div class="flex items-center gap-4 relative z-10">
                            <div class="w-14 h-14 bg-gray-700 rounded-full border-2 border-gray-600 flex items-center justify-center text-xl font-bold shadow-inner shrink-0">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="font-bold text-lg truncate">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-400 truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white dark:bg-gray-800 p-5 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-center items-center text-center">
                            <span class="text-3xl font-black text-gray-800 dark:text-gray-100">0</span>
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-1 uppercase tracking-wider">Laporan</span>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-5 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col justify-center items-center text-center">
                            <span class="text-3xl font-black text-gray-800 dark:text-gray-100">0</span>
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 mt-1 uppercase tracking-wider">Konseling</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>