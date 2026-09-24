<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Laporan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Kembali yang Simpel -->
            <a href="{{ route('bk.dashboard') }}" class="inline-flex items-center text-slate-400 hover:text-cyan-400 mb-6 text-sm font-medium transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>

            <!-- Card Utama (Bersih) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">
                
                <!-- Header (Judul & Badge Status) -->
                <div class="p-6 sm:p-8 border-b border-slate-700 bg-slate-800/50">
                    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                        <div>
                            <span class="inline-block px-3 py-1 rounded-full bg-slate-700 text-cyan-400 text-xs font-bold uppercase tracking-wider mb-3">
                                {{ $laporan->kategori }}
                            </span>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2">{{ $laporan->judul }}</h3>
                            <p class="text-slate-400 text-sm">Dilaporkan pada {{ $laporan->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        
                        <!-- Status Badge di Pojok Kanan -->
                        <div class="shrink-0">
                            @php
                                $statusColors = [
                                    'menunggu' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
                                    'diproses' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'selesai' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                ];
                            @endphp
                            <span class="px-4 py-2 rounded-xl text-sm font-bold border uppercase tracking-wider {{ $statusColors[$laporan->status] ?? 'bg-slate-500/10 text-slate-400 border-slate-500/20' }}">
                                {{ $laporan->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Konten Laporan -->
                <div class="p-6 sm:p-8 space-y-8">
                    
                    <!-- Box Pelapor yang Rapi -->
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-3 uppercase tracking-wider">Informasi Pelapor</p>
                        <div class="flex items-center gap-4 bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                            <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                @if($laporan->is_anonim)
                                    <p class="text-lg font-bold text-slate-300">Anonim (Identitas Dirahasiakan)</p>
                                @else
                                    <p class="text-lg font-bold text-white">{{ $laporan->user->name ?? 'Siswa (Tidak Diketahui)' }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Box Deskripsi yang Mudah Dibaca -->
                    <div>
                        <p class="text-sm font-semibold text-slate-400 mb-3 uppercase tracking-wider">Detail Kejadian</p>
                        <div class="bg-slate-900 border border-slate-700 rounded-xl p-6 text-slate-300 text-base leading-relaxed whitespace-pre-wrap">{{ $laporan->deskripsi }}</div>
                    </div>

                    <!-- Area Update Status -->
                    <div class="pt-6 border-t border-slate-700">
                        <p class="text-sm font-semibold text-slate-400 mb-4 uppercase tracking-wider">Tindak Lanjut Guru BK</p>
                        
                        <form action="{{ route('bk.laporan.update', $laporan->id) }}" method="POST" class="flex flex-col sm:flex-row gap-4">
                            @csrf
                            @method('PATCH')
                            
                            <select name="status" class="w-full sm:w-auto min-w-[250px] bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 outline-none">
                                <option value="menunggu" {{ $laporan->status == 'menunggu' ? 'selected' : '' }}>🟡 Menunggu Direspons</option>
                                <option value="diproses" {{ $laporan->status == 'diproses' ? 'selected' : '' }}>🔵 Sedang Diproses</option>
                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>🟢 Laporan Selesai</option>
                            </select>

                            <button type="submit" class="px-6 py-3 bg-cyan-500 hover:bg-cyan-400 text-slate-900 font-bold rounded-xl transition-colors">
                                Update Status
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>