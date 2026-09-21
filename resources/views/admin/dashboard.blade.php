<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center overflow-hidden shadow-sm">
                <img src="{{ asset('images/logoras.png') }}" alt="Logo RAS" 
                     class="w-full h-full object-cover" 
                     onerror="this.outerHTML='<span class=\'text-white font-bold text-lg\'>RAS</span>'">
            </div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>
        </div>
    </x-slot>

    <!-- Memaksa background menjadi gelap ala tema gambar -->
    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Sambutan: Tema Gradient Biru ke Cyan (Sesuai Gambar) -->
            <div class="bg-gradient-to-r from-blue-500 to-cyan-400 rounded-2xl shadow-lg p-6 sm:p-10 text-white overflow-hidden relative">
                <div class="relative z-10">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-2">Selamat datang, Administrator! ⚡</h3>
                    <p class="text-blue-50 text-sm sm:text-base max-w-2xl">
                        Ini adalah pusat kendali utama sistem Ruang Aman Siswa. Pantau statistik keseluruhan, kelola data pengguna, dan pastikan sistem berjalan lancar.
                    </p>
                </div>
                <!-- Efek cahaya di kanan atas -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-20 blur-2xl"></div>
            </div>

            <!-- Quick Stats dengan Tema Kartu Gelap (Slate 800) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kartu 1: Total Pengguna -->
                <div class="bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition hover:border-blue-500">
                    <h4 class="text-slate-400 text-sm font-medium mb-2">Total Akun Terdaftar</h4>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-white">0</p>
                        <span class="text-cyan-400 text-sm font-medium">Kelola User &rarr;</span>
                    </div>
                </div>

                <!-- Kartu 2: Log Sistem -->
                <div class="bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition hover:border-blue-500">
                    <h4 class="text-slate-400 text-sm font-medium mb-2">Laporan Keseluruhan</h4>
                    <div class="flex items-end justify-between">
                        <p class="text-4xl font-bold text-white">0</p>
                        <span class="text-cyan-400 text-sm font-medium">Lihat Data &rarr;</span>
                    </div>
                </div>

                <!-- Kartu 3: Role Aktif -->
                <div class="bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700 transition hover:border-blue-500">
                    <h4 class="text-slate-400 text-sm font-medium mb-2">Status Akun</h4>
                    <div class="flex items-end justify-between">
                        <p class="text-3xl font-bold text-blue-400">Admin</p>
                    </div>
                </div>
            </div>

            <!-- Area Konfigurasi -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 border border-slate-700">
                <h4 class="text-lg font-bold text-white mb-6">Akses Cepat Pengaturan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button class="p-4 bg-slate-700/50 border-2 border-slate-700 rounded-xl hover:border-blue-500 hover:bg-slate-700 transition text-left">
                        <h5 class="font-bold text-white">Manajemen Pengguna</h5>
                        <p class="text-sm text-slate-400 mt-1">Tambah, edit, atau hapus akun siswa dan Guru BK.</p>
                    </button>
                    <button class="p-4 bg-slate-700/50 border-2 border-slate-700 rounded-xl hover:border-blue-500 hover:bg-slate-700 transition text-left">
                        <h5 class="font-bold text-white">Pengaturan Sistem</h5>
                        <p class="text-sm text-slate-400 mt-1">Konfigurasi variabel dan status aplikasi Ruang Aman Siswa.</p>
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>