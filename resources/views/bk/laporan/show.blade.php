<x-app-layout>
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

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-5">

            <!-- Tombol Kembali -->
            <a href="{{ route('bk.dashboard') }}"
               class="inline-flex items-center text-slate-400 hover:text-cyan-400 text-sm font-medium transition-colors gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Dashboard
            </a>

            <!-- Alert Sukses -->
            @if(session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Card Utama -->
            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">

                <!-- Header Laporan -->
                <div class="p-6 sm:p-8 border-b border-slate-700 bg-slate-800/50">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div>
                            <span class="inline-block px-3 py-1 rounded-full bg-slate-700 text-cyan-400 text-xs font-bold uppercase tracking-wider mb-3">
                                {{ $laporan->kategori }}
                            </span>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">{{ $laporan->judul }}</h3>
                            <p class="text-slate-400 text-sm">Dilaporkan pada {{ $laporan->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        @php
                            $statusColors = [
                                'menunggu' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                'diproses' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                'selesai'  => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                            ];
                        @endphp
                        <span class="shrink-0 px-4 py-2 rounded-xl text-sm font-bold border uppercase tracking-wider {{ $statusColors[$laporan->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20' }}">
                            {{ $laporan->status }}
                        </span>
                    </div>
                </div>

                <div class="p-6 sm:p-8 space-y-8">

                    <!-- Info Pelapor -->
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-3 uppercase tracking-wider">Informasi Pelapor</p>
                        <div class="flex items-center gap-4 bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                            <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 border border-slate-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                @if($laporan->is_anonim)
                                    <p class="text-lg font-bold text-slate-300">Anonim (Identitas Dirahasiakan)</p>
                                    <p class="text-xs text-slate-500">Identitas pelapor dijaga kerahasiaannya oleh sistem.</p>
                                @else
                                    <p class="text-lg font-bold text-white">{{ $laporan->user->name ?? 'Siswa (Tidak Diketahui)' }}</p>
                                    <p class="text-xs text-slate-500">{{ $laporan->user->email ?? '' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Isi Laporan -->
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-3 uppercase tracking-wider">Detail Kejadian</p>
                        @if($laporan->tanggal_kejadian)
                            <p class="text-xs text-slate-500 mb-2 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Tanggal kejadian: {{ \Carbon\Carbon::parse($laporan->tanggal_kejadian)->format('d M Y') }}
                            </p>
                        @endif
                        <div class="bg-slate-900 border border-slate-700 rounded-xl p-6 text-slate-300 text-base leading-relaxed whitespace-pre-wrap">{{ $laporan->deskripsi }}</div>
                    </div>

                    <!-- ========================================= -->
                    <!-- BALASAN / CATATAN BK YANG SUDAH DIKIRIM  -->
                    <!-- ========================================= -->
                    @if($laporan->catatan_bk)
                        <div>
                            <p class="text-sm font-semibold text-slate-400 mb-3 uppercase tracking-wider flex items-center gap-2">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                Catatan / Balasan BK
                            </p>
                            <div class="bg-cyan-500/5 border border-cyan-500/20 rounded-xl p-5 text-slate-300 text-sm leading-relaxed whitespace-pre-wrap">
                                {{ $laporan->catatan_bk }}
                            </div>
                        </div>
                    @endif

                    <!-- ========================================= -->
                    <!-- FORM TINDAK LANJUT (UPDATE STATUS + CATATAN) -->
                    <!-- ========================================= -->
                    <div class="pt-6 border-t border-slate-700">
                        <p class="text-sm font-semibold text-slate-400 mb-4 uppercase tracking-wider">Tindak Lanjut Guru BK</p>

                        <form action="{{ route('bk.laporan.update', $laporan->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <!-- Dropdown Status -->
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">Update Status</label>
                                <select name="status"
                                    class="w-full sm:w-auto min-w-[250px] bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none">
                                    <option value="menunggu" {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>🟡 Menunggu Direspons</option>
                                    <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>🔵 Sedang Diproses</option>
                                    <option value="selesai"  {{ $laporan->status == 'selesai'  ? 'selected' : '' }}>🟢 Laporan Selesai</option>
                                </select>
                            </div>

                            <!-- Textarea Catatan/Balasan -->
                            <div>
                                <label class="block text-sm font-medium text-slate-400 mb-2">
                                    Catatan / Balasan untuk Siswa
                                    <span class="text-slate-500 font-normal">(Opsional — akan terlihat oleh siswa pelapor)</span>
                                </label>
                                <textarea name="catatan_bk" rows="4"
                                    placeholder="Tulis balasan atau catatan tindak lanjut untuk siswa pelapor..."
                                    class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none resize-none text-sm leading-relaxed"
                                >{{ old('catatan_bk', $laporan->catatan_bk) }}</textarea>
                            </div>

                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold rounded-xl transition shadow-lg shadow-cyan-500/20">
                                Simpan & Update
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>