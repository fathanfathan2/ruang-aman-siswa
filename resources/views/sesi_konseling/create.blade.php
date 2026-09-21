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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Header Form (Gradient Cyan-Blue) -->
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold tracking-wide">Booking Sesi Konseling</h3>
                    <p class="text-blue-100 text-sm mt-1">Isi formulir di bawah untuk menjadwalkan pertemuan dengan Guru BK.</p>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Card Form Utama (Slate 800) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-700">

                <!-- Validasi Error (Logika Asli Davin) -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-sm">
                        <p class="font-semibold mb-1">Terjadi kesalahan pada isian kamu:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sesi-konseling.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Input Topik Konseling -->
                    <div>
                        <label for="topik" class="block text-sm font-medium text-slate-300 mb-2">Topik Konseling</label>
                        <input type="text" id="topik" name="topik" value="{{ old('topik') }}"
                               placeholder="Contoh: Kesulitan mengatur waktu belajar"
                               class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-blue-500 text-white rounded-xl p-3.5 text-sm placeholder-slate-400 transition">
                        @error('topik')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Jadwal Konseling -->
                    <div>
                        <label for="jadwal" class="block text-sm font-medium text-slate-300 mb-2">Jadwal Konseling</label>
                        <input type="datetime-local" id="jadwal" name="jadwal" value="{{ old('jadwal') }}"
                               class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-blue-500 text-white rounded-xl p-3.5 text-sm transition">
                        @error('jadwal')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Radio Tipe Konseling -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Tipe Konseling</label>
                        <div class="flex gap-4">
                            <label class="flex-1 flex items-center gap-3 bg-slate-700/50 border border-slate-600 rounded-xl p-3.5 text-sm text-white cursor-pointer hover:border-blue-500 transition">
                                <input type="type" name="tipe" value="terbuka" class="text-blue-600 focus:ring-blue-500 bg-slate-700 border-slate-600"
                                       {{ old('tipe', 'terbuka') == 'terbuka' ? 'checked' : '' }}>
                                Terbuka
                            </label>
                            <label class="flex-1 flex items-center gap-3 bg-slate-700/50 border border-slate-600 rounded-xl p-3.5 text-sm text-white cursor-pointer hover:border-blue-500 transition">
                                <input type="radio" name="tipe" value="anonim" class="text-blue-600 focus:ring-blue-500 bg-slate-700 border-slate-600"
                                       {{ old('tipe') == 'anonim' ? 'checked' : '' }}>
                                Anonim
                            </label>
                        </div>
                        @error('tipe')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-700 mt-4">
                        <a href="{{ route('sesi-konseling.index') }}" class="text-sm text-slate-400 hover:text-slate-200 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 px-8 rounded-xl transition shadow-lg shadow-blue-500/30 tracking-wide text-sm">
                            BOOKING KONSELING
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>