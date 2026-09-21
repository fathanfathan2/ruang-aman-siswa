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

            <!-- Banner Header Form (Gradient Biru-Indigo) -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <!-- Tombol Kembali -->
                    <a href="/dashboard" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-100 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Dashboard
                    </a>
                    <h3 class="text-2xl font-bold tracking-wide mt-2">Booking Sesi Konseling</h3>
                    <p class="text-blue-100 text-sm mt-1">Isi formulir di bawah untuk menjadwalkan pertemuan dengan Guru BK. Privasimu aman di sini.</p>
                </div>
                <!-- Efek cahaya blur -->
                <div class="absolute top-0 right-0 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-300 opacity-10 rounded-full blur-2xl -ml-10 -mb-10"></div>
            </div>

            <!-- Card Form Utama (Slate 800) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-700/60">

                <!-- Validasi Error -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-sm">
                        <p class="font-semibold mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terjadi kesalahan pada isian kamu:
                        </p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <form action="{{ route('sesi-konseling.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Input Topik Konseling -->
                    <div>
                        <label for="topik" class="block text-sm font-semibold text-slate-300 mb-2">Topik Konseling</label>
                        <input
                            type="text"
                            id="topik"
                            name="topik"
                            value="{{ old('topik') }}"
                            placeholder="Contoh: Masalah Akademik / Bullying / Karir"
                            class="w-full bg-slate-700/70 border border-slate-600/60 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 text-white rounded-xl p-3.5 text-sm placeholder-slate-500 transition outline-none"
                        >
                        @error('topik')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Jadwal Konseling -->
                    <div>
                        <label for="jadwal" class="block text-sm font-semibold text-slate-300 mb-2">Rencana Jadwal</label>
                        <input
                            type="datetime-local"
                            id="jadwal"
                            name="jadwal"
                            value="{{ old('jadwal') }}"
                            class="w-full bg-slate-700/70 border border-slate-600/60 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 text-white rounded-xl p-3.5 text-sm transition outline-none [color-scheme:dark]"
                        >
                        @error('jadwal')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipe Konseling -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-3">Tipe Konseling</label>
                        <div class="grid grid-cols-2 gap-3">

                            <!-- Opsi Terbuka -->
                            <label class="flex flex-col gap-2 bg-slate-700/50 border border-slate-600/60 rounded-xl p-4 text-sm text-white cursor-pointer hover:border-blue-500/70 hover:bg-slate-700 transition group">
                                <div class="flex items-center gap-2.5">
                                    <input type="radio" name="tipe" value="terbuka"
                                           class="text-blue-600 focus:ring-blue-500 bg-slate-700 border-slate-500"
                                           {{ old('tipe', 'terbuka') == 'terbuka' ? 'checked' : '' }}>
                                    <span class="font-semibold">Terbuka</span>
                                </div>
                                <p class="text-xs text-slate-400 group-hover:text-slate-300 leading-relaxed pl-5">Identitas kamu diketahui oleh Guru BK.</p>
                            </label>

                            <!-- Opsi Anonim -->
                            <label class="flex flex-col gap-2 bg-slate-700/50 border border-slate-600/60 rounded-xl p-4 text-sm text-white cursor-pointer hover:border-indigo-500/70 hover:bg-slate-700 transition group">
                                <div class="flex items-center gap-2.5">
                                    <input type="radio" name="tipe" value="anonim"
                                           class="text-indigo-600 focus:ring-indigo-500 bg-slate-700 border-slate-500"
                                           {{ old('tipe') == 'anonim' ? 'checked' : '' }}>
                                    <span class="font-semibold">Anonim</span>
                                </div>
                                <p class="text-xs text-slate-400 group-hover:text-slate-300 leading-relaxed pl-5">Nama kamu dirahasiakan sepenuhnya.</p>
                            </label>

                        </div>
                        @error('tipe')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-slate-700/60 pt-2"></div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-between">
                        <a href="/dashboard" class="text-sm text-slate-400 hover:text-slate-200 transition font-medium flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-2.5 px-8 rounded-xl transition shadow-lg shadow-blue-500/20 tracking-wide text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Ajukan Jadwal
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>