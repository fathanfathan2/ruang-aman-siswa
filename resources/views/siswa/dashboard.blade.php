<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-2">
                        Selamat datang, {{ Auth::user()->name }}! 👋
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Ini adalah halaman utama untuk role <span class="font-semibold text-blue-600 dark:text-blue-400">Siswa</span>.
                        Di sini kamu bisa mengakses layanan konseling "Ruang Aman Siswa".
                    </p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status Laporan</p>
                            <p class="text-xl font-semibold text-gray-800 dark:text-gray-100">Belum ada</p>
                        </div>
                        <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sesi Konseling</p>
                            <p class="text-xl font-semibold text-gray-800 dark:text-gray-100">0</p>
                        </div>
                        <div class="bg-blue-50 dark:bg-gray-700 p-4 rounded-lg">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Role Aktif</p>
                            <p class="text-xl font-semibold text-gray-800 dark:text-gray-100">Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>