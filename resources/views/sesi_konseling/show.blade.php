<x-app-layout>
    <!-- Header Standar -->
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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-5">

            <!-- Banner Header -->
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white relative overflow-hidden">
                <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <!-- Tombol Kembali -->
                        <a href="{{ route('sesi-konseling.index') }}"
                           class="mb-3 inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Daftar
                        </a>
                        <h3 class="text-2xl font-bold tracking-wide">Detail Sesi Konseling</h3>
                        <p class="text-blue-100 text-sm mt-1">Informasi & ruang diskusi sesi konseling.</p>
                    </div>
                    <!-- Status Badge -->
                    <div class="shrink-0">
                        @php
                            $statusBadge = [
                                'menunggu'  => 'bg-amber-400/20 text-amber-200 border-amber-400/30',
                                'disetujui' => 'bg-emerald-400/20 text-emerald-200 border-emerald-400/30',
                                'ditolak'   => 'bg-rose-400/20 text-rose-200 border-rose-400/30',
                                'selesai'   => 'bg-slate-400/20 text-slate-200 border-slate-400/30',
                            ];
                        @endphp
                        <span class="inline-block px-4 py-2 rounded-xl text-sm font-bold uppercase tracking-wider border {{ $statusBadge[$sesiKonseling->status] ?? 'bg-white/10 text-white border-white/20' }}">
                            {{ ucfirst($sesiKonseling->status) }}
                        </span>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Alert Sukses Status -->
            @if (session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Card Info Detail -->
            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-700 bg-slate-800/50">
                    <h4 class="text-base font-bold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Informasi Konseling
                    </h4>
                </div>
                <dl class="divide-y divide-slate-700/50 px-6">
                    <div class="py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                        <dt class="text-sm font-medium text-slate-400">Topik Konseling</dt>
                        <dd class="text-white font-semibold sm:text-right">{{ $sesiKonseling->topik }}</dd>
                    </div>
                    <div class="py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                        <dt class="text-sm font-medium text-slate-400">Jadwal Pertemuan</dt>
                        <dd class="text-white font-semibold sm:text-right flex items-center gap-2 sm:justify-end">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $sesiKonseling->jadwal->format('d M Y, H:i') }}
                        </dd>
                    </div>
                    <div class="py-4 flex justify-between items-center">
                        <dt class="text-sm font-medium text-slate-400">Tipe</dt>
                        <dd>
                            <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border
                                {{ $sesiKonseling->tipe === 'terbuka'
                                    ? 'bg-blue-500/10 text-blue-400 border-blue-500/20'
                                    : 'bg-purple-500/10 text-purple-400 border-purple-500/20' }}">
                                {{ ucfirst($sesiKonseling->tipe) }}
                            </span>
                        </dd>
                    </div>
                    @if ($sesiKonseling->tipe !== 'anonim' && $sesiKonseling->siswa)
                        <div class="py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                            <dt class="text-sm font-medium text-slate-400">Nama Siswa</dt>
                            <dd class="text-white font-semibold sm:text-right flex items-center gap-2 sm:justify-end">
                                <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center text-xs text-white font-bold">
                                    {{ substr($sesiKonseling->siswa->name, 0, 1) }}
                                </div>
                                {{ $sesiKonseling->siswa->name }}
                            </dd>
                        </div>
                    @endif
                </dl>

                <!-- Aksi Update Status (hanya untuk Guru BK) -->
                @if(auth()->user()->role === 'bk')
                    <div class="px-6 py-4 border-t border-slate-700 bg-slate-900/30">
                        <p class="text-xs text-slate-400 mb-3 font-medium uppercase tracking-wider">Ubah Status Konseling</p>
                        <div class="flex flex-wrap gap-2">
                            @if($sesiKonseling->status === 'menunggu')
                                <form action="{{ route('bk.konseling.update', $sesiKonseling->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white text-xs font-bold px-4 py-2 rounded-lg transition shadow-md shadow-emerald-500/20 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('bk.konseling.update', $sesiKonseling->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 border border-rose-500/30 text-xs font-bold px-4 py-2 rounded-lg transition flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Tolak
                                    </button>
                                </form>
                            @endif
                            @if($sesiKonseling->status === 'disetujui')
                                <form action="{{ route('bk.konseling.update', $sesiKonseling->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="bg-slate-600 hover:bg-slate-500 text-white text-xs font-bold px-4 py-2 rounded-lg transition flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Tandai Selesai
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- ============================================ -->
            <!-- RUANG DISKUSI / TANYA JAWAB (CHAT)          -->
            <!-- ============================================ -->
            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">

                <!-- Header Chat -->
                <div class="px-6 py-4 border-b border-slate-700 bg-slate-800/50 flex items-center gap-3">
                    <div class="p-2 bg-cyan-500/10 rounded-xl border border-cyan-500/20">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-white">Ruang Diskusi</h4>
                        <p class="text-xs text-slate-400">Komunikasi langsung antara siswa & Guru BK</p>
                    </div>
                    <span class="ml-auto bg-slate-700 text-slate-300 text-xs font-bold px-2.5 py-1 rounded-full border border-slate-600">
                        {{ $sesiKonseling->pesans->count() }} pesan
                    </span>
                </div>

                <!-- Daftar Pesan -->
                <div class="p-5 sm:p-6 space-y-4 min-h-56 max-h-[28rem] overflow-y-auto" id="chat-messages">
                    @forelse($sesiKonseling->pesans as $pesan)
                        @php
                            $isMine   = $pesan->pengirim_id === auth()->id();
                            $isAnonim = $sesiKonseling->tipe === 'anonim';
                            $isBk     = auth()->user()->role === 'bk';
                            $isSiswa  = $pesan->pengirim_id === $sesiKonseling->siswa_id;

                            // Tentukan nama pengirim yang ditampilkan
                            if ($isMine) {
                                $senderName = 'Kamu';
                                $avatarLetter = substr(auth()->user()->name, 0, 1);
                            } elseif ($isAnonim && $isBk && $isSiswa) {
                                $senderName   = '🔒 Anonim';
                                $avatarLetter = '?';
                            } else {
                                $senderName   = $pesan->pengirim->name ?? 'Pengguna';
                                $avatarLetter = substr($pesan->pengirim->name ?? '?', 0, 1);
                            }
                        @endphp

                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} items-end gap-2">

                            {{-- Avatar kiri (bukan milik saya) --}}
                            @if(!$isMine)
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0 border
                                    {{ $isAnonim && $isBk && $isSiswa
                                        ? 'bg-slate-600 text-slate-400 border-slate-500'
                                        : 'bg-cyan-600 text-white border-cyan-500' }}">
                                    {{ strtoupper($avatarLetter) }}
                                </div>
                            @endif

                            <div class="max-w-xs sm:max-w-sm lg:max-w-md">
                                {{-- Label nama pengirim (hanya jika bukan pesan saya) --}}
                                @if(!$isMine)
                                    <p class="text-xs text-slate-400 mb-1 ml-1 font-medium">{{ $senderName }}</p>
                                @endif

                                {{-- Bubble Pesan --}}
                                <div class="{{ $isMine
                                    ? 'bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-2xl rounded-br-sm'
                                    : 'bg-slate-700 text-slate-200 rounded-2xl rounded-bl-sm' }} px-4 py-3 shadow-sm">
                                    <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $pesan->isi }}</p>
                                </div>

                                {{-- Timestamp --}}
                                <p class="text-[10px] text-slate-500 mt-1.5 {{ $isMine ? 'text-right mr-1' : 'ml-1' }}">
                                    {{ $pesan->created_at->diffForHumans() }} · {{ $pesan->created_at->format('H:i') }}
                                </p>
                            </div>

                            {{-- Avatar kanan (pesan saya) --}}
                            @if($isMine)
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-xs font-bold text-white shrink-0 border border-blue-500">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif

                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div class="bg-slate-700/50 p-5 rounded-full mb-4 ring-4 ring-slate-800">
                                <svg class="w-9 h-9 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <p class="text-slate-300 font-semibold">Belum ada pesan</p>
                            <p class="text-slate-500 text-sm mt-1 max-w-xs leading-relaxed">
                                Mulai diskusi dengan mengirim pesan pertama di bawah!
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Form Kirim Pesan -->
                @if(in_array($sesiKonseling->status, ['menunggu', 'disetujui']))
                    <div class="px-5 sm:px-6 py-4 border-t border-slate-700 bg-slate-800/60">

                        {{-- Alert pesan terkirim --}}
                        @if (session('pesan_success'))
                            <div class="mb-3 p-2.5 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <p class="text-emerald-400 text-xs font-medium">{{ session('pesan_success') }}</p>
                            </div>
                        @endif

                        {{-- Error validasi --}}
                        @error('isi')
                            <div class="mb-3 p-2.5 rounded-lg bg-rose-500/10 border border-rose-500/20">
                                <p class="text-rose-400 text-xs font-medium">{{ $message }}</p>
                            </div>
                        @enderror

                        <form action="{{ route('sesi-konseling.pesan.store', $sesiKonseling->id) }}" method="POST">
                            @csrf
                            <div class="flex gap-3 items-end">
                                <div class="flex-1">
                                    <textarea
                                        name="isi"
                                        rows="2"
                                        placeholder="Tulis pesan kamu di sini..."
                                        class="w-full bg-slate-700/70 border border-slate-600/60 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 text-white rounded-xl px-4 py-3 text-sm placeholder-slate-500 transition outline-none resize-none leading-relaxed"
                                    >{{ old('isi') }}</textarea>
                                </div>
                                <button type="submit"
                                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white p-3.5 rounded-xl transition shadow-lg shadow-blue-500/20 shrink-0 group">
                                    <svg class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Sesi sudah selesai / ditolak -->
                    <div class="px-6 py-4 border-t border-slate-700 text-center">
                        <p class="text-slate-500 text-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Sesi ini telah
                            <span class="font-semibold text-slate-400">{{ $sesiKonseling->status === 'selesai' ? 'selesai' : 'ditolak' }}</span>.
                            Diskusi tidak dapat dilanjutkan.
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Auto scroll ke bawah chat --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chat-messages');
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
    </script>

</x-app-layout>