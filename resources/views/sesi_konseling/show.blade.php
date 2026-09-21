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
            
            <!-- Banner Header Detail (Gradient Cyan-Blue) -->
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white relative overflow-hidden flex justify-between items-center">
                <div class="relative z-10">
                    <!-- Tombol Kembali -->
                    <a href="{{ route('sesi-konseling.index') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar
                    </a>
                    
                    <h3 class="text-2xl font-bold tracking-wide">Detail Sesi Konseling</h3>
                    <p class="text-blue-100 text-sm mt-1">Informasi lengkap mengenai jadwal pertemuan tatap muka.</p>
                </div>
                
                <!-- Icon Dekoratif -->
                <div class="relative z-10 hidden sm:block opacity-80">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Card Detail (Slate 800) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-700">
                <dl class="divide-y divide-slate-700/50">
                    
                    <!-- Topik -->
                    <div class="py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                        <dt class="font-medium text-slate-400 text-sm">Topik Konseling</dt>
                        <dd class="text-white font-semibold text-base sm:text-right">{{ $sesiKonseling->topik }}</dd>
                    </div>
                    
                    <!-- Jadwal -->
                    <div class="py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                        <dt class="font-medium text-slate-400 text-sm">Jadwal Pertemuan</dt>
                        <dd class="text-white font-semibold text-base sm:text-right flex items-center gap-2 sm:justify-end">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $sesiKonseling->jadwal->format('d M Y, H:i') }}
                        </dd>
                    </div>

                    <!-- Tipe Konseling -->
                    <div class="py-4 flex justify-between items-center text-sm gap-2">
                        <dt class="font-medium text-slate-400">Tipe</dt>
                        <dd>
                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border 
                                {{ $sesiKonseling->tipe === 'terbuka' ? 'bg-blue-500/10 text-blue-400 border-blue-500/20' : 'bg-purple-500/10 text-purple-400 border-purple-500/20' }}">
                                {{ ucfirst($sesiKonseling->tipe) }}
                            </span>
                        </dd>
                    </div>

                    <!-- Status -->
                    <div class="py-4 flex justify-between items-center text-sm gap-2">
                        <dt class="font-medium text-slate-400">Status</dt>
                        <dd>
                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border
                                @if ($sesiKonseling->status === 'menunggu') bg-amber-500/10 text-amber-400 border-amber-500/20
                                @elseif ($sesiKonseling->status === 'disetujui') bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                @else bg-rose-500/10 text-rose-400 border-rose-500/20
                                @endif">
                                {{ ucfirst($sesiKonseling->status) }}
                            </span>
                        </dd>
                    </div>

                    <!-- Siswa (Muncul jika BUKAN anonim) -->
                    @if ($sesiKonseling->tipe !== 'anonim' && $sesiKonseling->siswa)
                        <div class="py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                            <dt class="font-medium text-slate-400 text-sm">Nama Siswa</dt>
                            <dd class="text-white font-semibold text-base sm:text-right flex items-center gap-2 sm:justify-end">
                                <div class="w-6 h-6 bg-slate-700 rounded-full flex items-center justify-center text-xs text-slate-300 font-bold border border-slate-600">
                                    {{ substr($sesiKonseling->siswa->name, 0, 1) }}
                                </div>
                                {{ $sesiKonseling->siswa->name }}
                            </dd>
                        </div>
                    @endif

                </dl>
            </div>
            
        </div>
    </div>
</x-app-layout>