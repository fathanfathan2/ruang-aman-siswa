<x-app-layout>
<<<<<<< HEAD
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <!-- Logo dengan Fallback -->
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center overflow-hidden shadow-sm">
                <img src="{{ asset('images/logoras.png') }}" alt="Logo RAS" 
                     class="w-full h-full object-cover" 
                     onerror="this.outerHTML='<span class=\'text-white font-bold text-lg\'>RAS</span>'">
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard Guru BK') }}
=======
<x-slot name="header">
        <div class="flex items-center gap-5">
            <img src="{{ asset('images/logoras.png') }}" 
                 alt="Logo RAS" 
                 class="h-16 w-auto object-contain drop-shadow-md"
                 onerror="this.outerHTML='<div class=\'h-16 w-16 bg-blue-500 rounded-xl flex items-center justify-center text-white font-bold\'>RAS</div>'">
            
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-wide">
                {{ __('Ruang Aman Siswa') }}
>>>>>>> 12fe6072270c266e8511c7382bd2ae15e3119904
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Sambutan -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 rounded-2xl shadow-lg p-6 sm:p-10 text-white overflow-hidden relative">
                <div class="relative z-10">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-2">Selamat datang, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-blue-100 text-sm sm:text-base max-w-2xl">
                        Ini adalah pusat kendali untuk Guru BK. Pantau laporan siswa, kelola jadwal sesi konseling, dan berikan penanganan dengan cepat dan tepat.
                    </p>
                </div>
                <!-- Hiasan Background (Lingkaran) -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-2xl"></div>
            </div>

            <!-- Quick Stats / Statistik Cepat -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kartu 1: Laporan Baru -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-2">Laporan Menunggu</h4>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">0</p>
                        <span class="text-blue-500 text-sm font-medium">Lihat Laporan &rarr;</span>
                    </div>
                </div>

                <!-- Kartu 2: Jadwal Konseling -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-2">Jadwal Konseling Hari Ini</h4>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">0</p>
                        <span class="text-blue-500 text-sm font-medium">Buka Jadwal &rarr;</span>
                    </div>
                </div>

                <!-- Kartu 3: Role Aktif -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                    <h4 class="text-gray-500 dark:text-gray-400 text-sm font-medium mb-2">Status Akun</h4>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">Guru BK</p>
                    </div>
                </div>
            </div>

            <!-- Area Aktivitas / Empty State -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Aktivitas Terakhir</h4>
                <div class="flex flex-col items-center justify-center py-10 text-center bg-gray-50 dark:bg-gray-900/50 rounded-xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                    <div class="text-gray-400 mb-3">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 font-medium">Belum ada aktivitas terbaru.</p>
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Laporan siswa dan riwayat konseling akan muncul di sini.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>