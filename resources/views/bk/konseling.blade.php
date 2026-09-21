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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Banner Header (Gradient Biru-Indigo) -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-2xl shadow-lg p-6 sm:p-8 flex justify-between items-center border-b border-blue-500/30 relative overflow-hidden">
                <div class="relative z-10">
                    <!-- Tombol Kembali -->
                    <a href="/dashboard" class="mb-3 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-100 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Dashboard
                    </a>
                    <h3 class="text-2xl font-bold text-white tracking-wide">Daftar Pengajuan Konseling Siswa</h3>
                    <p class="text-blue-100 text-sm mt-1">Kelola dan tinjau semua pengajuan jadwal konseling dari siswa.</p>
                </div>
                <!-- Efek cahaya -->
                <div class="absolute top-0 right-0 w-72 h-72 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Area Konten Utama (Kartu Slate 800) -->
            <div class="bg-slate-800 rounded-b-2xl shadow-xl p-6 sm:p-8 border-x border-b border-slate-700/60">

                <!-- Alert Pesan Sukses -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Tabel Pengajuan -->
                <div class="overflow-x-auto rounded-xl border border-slate-700/60">
                    <table class="w-full text-sm text-left text-slate-300">
                        <thead class="text-xs uppercase bg-slate-900/60 text-slate-400 border-b border-slate-700/60">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold">No</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Siswa</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Topik</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Tipe</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Jadwal Diajukan</th>
                                <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/40">
                            {{-- Baris contoh statis (data asli bisa di-loop dari controller) --}}
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">1</td>
                                <td class="px-6 py-4 font-bold text-white">Siswa Terbuka</td>
                                <td class="px-6 py-4 text-slate-300">Masalah Akademik</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">Terbuka</span>
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        2026-09-20 10:00
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">Menunggu</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="/bk/konseling/1/status" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shadow-md shadow-emerald-500/20">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="/bk/konseling/1/status" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 border border-rose-500/30 text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-6 py-4 font-medium text-slate-400">2</td>
                                <td class="px-6 py-4 font-bold text-slate-500 italic">Anonim</td>
                                <td class="px-6 py-4 text-slate-300">Bullying</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-purple-500/10 text-purple-400 border border-purple-500/20">Anonim</span>
                                </td>
                                <td class="px-6 py-4 text-slate-400">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        2026-09-21 13:00
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/20">Menunggu</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="/bk/konseling/2/status" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white text-xs font-bold px-3 py-1.5 rounded-lg transition shadow-md shadow-emerald-500/20">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="/bk/konseling/2/status" method="POST" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 border border-rose-500/30 text-xs font-bold px-3 py-1.5 rounded-lg transition">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- Jika data kosong tampilkan placeholder --}}
                            @isset($pengajuans)
                                @forelse($pengajuans as $item)
                                {{-- Loop data asli dari controller nanti --}}
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 mb-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                <p class="font-medium text-slate-400">Belum ada pengajuan konseling dari siswa.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @endisset

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>