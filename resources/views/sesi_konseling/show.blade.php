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
                        @php
                            $backUrl = match(auth()->user()->role) {
                                'siswa' => route('siswa.dashboard'),
                                'bk'    => route('bk.konseling.index'),
                                default => route('sesi-konseling.index'),
                            };
                            $backLabel = match(auth()->user()->role) {
                                'siswa' => 'Kembali ke Dashboard',
                                'bk'    => 'Kembali ke Konseling BK',
                                default => 'Kembali ke Daftar',
                            };
                        @endphp
                        <a href="{{ $backUrl }}"
                           class="mb-3 inline-flex items-center gap-1.5 text-sm font-semibold text-cyan-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            {{ $backLabel }}
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

                <!-- Aksi Update Status (Guru BK & Admin) -->
                @if(in_array(auth()->user()->role, ['bk', 'admin']))
                    <div class="px-6 py-4 border-t border-slate-700 bg-slate-900/30">
                        <p class="text-xs text-slate-400 mb-3 font-medium uppercase tracking-wider">Ubah Status Konseling</p>
                        <div class="flex flex-wrap gap-2">
                            @if($sesiKonseling->status === 'menunggu')
                                <form action="{{ route('bk.konseling.update', $sesiKonseling->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit" class="bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white text-xs font-bold px-4 py-2 rounded-lg transition shadow-md shadow-emerald-500/20 flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Setujui Sesi
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
            <!-- RUANG DISKUSI / TANYA JAWAB (CHAT REALTIME) -->
            <!-- ============================================ -->
            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">

                <!-- Header Chat -->
                <div class="px-6 py-4 border-b border-slate-700 bg-slate-800/50 flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-cyan-500/10 rounded-xl border border-cyan-500/20">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="text-base font-bold text-white">Ruang Diskusi</h4>
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                    Live
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">Komunikasi langsung antara Siswa & Guru BK</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        @if(in_array(auth()->user()->role ?? '', ['bk', 'admin']))
                            <button type="button"
                                id="btn-clear-chat"
                                title="Hapus semua riwayat obrolan dalam sesi ini"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-rose-300 hover:text-white bg-rose-500/10 hover:bg-rose-600 border border-rose-500/30 hover:border-rose-600 transition shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus Obrolan
                            </button>
                        @endif
                        <span id="chat-count-badge" class="bg-slate-700 text-slate-300 text-xs font-bold px-3 py-1 rounded-full border border-slate-600 shadow-sm">
                            {{ $sesiKonseling->pesans->count() }} pesan
                        </span>
                    </div>
                </div>

                <!-- Daftar Pesan (Container Scroll) -->
                <div class="p-5 sm:p-6 space-y-4 min-h-64 max-h-[30rem] overflow-y-auto" id="chat-messages">
                    @forelse($sesiKonseling->pesans as $pesan)
                        @php
                            $isMine     = $pesan->pengirim_id === auth()->id();
                            $isAnonim   = $sesiKonseling->tipe === 'anonim';
                            $isBkOrAdm  = in_array(auth()->user()->role ?? '', ['bk', 'admin']);
                            $isSiswa    = $pesan->pengirim_id === $sesiKonseling->siswa_id;
                            $senderRole = $pesan->pengirim->role ?? 'siswa';
                            $isSenderBk = in_array($senderRole, ['bk', 'admin']);

                            // Tentukan nama pengirim yang ditampilkan
                            if ($isMine) {
                                $senderName   = 'Kamu';
                                $avatarLetter = substr(auth()->user()->name, 0, 1);
                            } elseif ($isAnonim && $isBkOrAdm && $isSiswa) {
                                $senderName   = '🔒 Anonim';
                                $avatarLetter = '?';
                            } else {
                                $senderName   = $pesan->pengirim->name ?? 'Pengguna';
                                $avatarLetter = substr($pesan->pengirim->name ?? '?', 0, 1);
                            }
                        @endphp

                        <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }} items-end gap-2.5 message-row group" data-id="{{ $pesan->id }}">

                            {{-- Avatar kiri (bukan pesan saya) --}}
                            @if(!$isMine)
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0 border shadow-sm
                                    {{ $isSenderBk
                                        ? 'bg-gradient-to-tr from-emerald-600 to-teal-500 text-white border-emerald-400/40'
                                        : ($isAnonim && $isBkOrAdm && $isSiswa
                                            ? 'bg-slate-700 text-slate-400 border-slate-600'
                                            : 'bg-gradient-to-tr from-cyan-600 to-blue-500 text-white border-cyan-400/40') }}">
                                    {{ strtoupper($avatarLetter) }}
                                </div>
                            @endif

                            <div class="max-w-xs sm:max-w-sm lg:max-w-md">
                                {{-- Label identitas pengirim (hanya jika pesan orang lain) --}}
                                @if(!$isMine)
                                    <div class="flex items-center gap-1.5 mb-1 ml-1">
                                        <span class="text-xs font-semibold text-slate-300">{{ $senderName }}</span>
                                        @if($isSenderBk)
                                            <span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[9px] font-bold px-1.5 py-0.2 rounded-full">
                                                Guru BK
                                            </span>
                                        @elseif($isAnonim && $isBkOrAdm && $isSiswa)
                                            <span class="bg-slate-600/30 text-slate-400 border border-slate-600/50 text-[9px] font-bold px-1.5 py-0.2 rounded-full">
                                                Anonim
                                            </span>
                                        @else
                                            <span class="bg-blue-500/20 text-blue-300 border border-blue-500/30 text-[9px] font-bold px-1.5 py-0.2 rounded-full">
                                                Siswa
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Bubble Pesan --}}
                                <div class="{{ $isMine
                                    ? 'bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-2xl rounded-br-sm shadow-md shadow-blue-600/20'
                                    : ($isSenderBk
                                        ? 'bg-slate-700/90 text-slate-100 rounded-2xl rounded-bl-sm border border-emerald-500/30 shadow-sm'
                                        : 'bg-slate-700 text-slate-100 rounded-2xl rounded-bl-sm border border-slate-600 shadow-sm') }} px-4 py-3">
                                    <p class="text-sm leading-relaxed whitespace-pre-wrap break-words">{{ $pesan->isi }}</p>
                                </div>

                                {{-- Timestamp & Tombol Hapus Satuan --}}
                                <div class="flex items-center gap-2 mt-1 {{ $isMine ? 'justify-end mr-1' : 'ml-1' }}">
                                    <p class="text-[10px] text-slate-500">
                                        {{ $pesan->created_at->format('H:i') }} · {{ $pesan->created_at->diffForHumans() }}
                                    </p>
                                    @if(in_array(auth()->user()->role ?? '', ['bk', 'admin']) || $isMine)
                                        <button type="button"
                                            onclick="deleteSingleMessage({{ $pesan->id }})"
                                            title="Hapus pesan ini"
                                            class="opacity-0 group-hover:opacity-100 transition-opacity text-slate-500 hover:text-rose-400 p-0.5 rounded"
                                        >
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Avatar kanan (pesan saya) --}}
                            @if($isMine)
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center text-xs font-bold shrink-0 border border-blue-400/40 shadow-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif

                        </div>
                    @empty
                        <!-- Empty State -->
                        <div id="chat-empty-state" class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="bg-slate-700/50 p-5 rounded-full mb-4 ring-4 ring-slate-800">
                                <svg class="w-9 h-9 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <p class="text-slate-200 font-semibold">Belum ada obrolan</p>
                            <p class="text-slate-400 text-sm mt-1 max-w-xs leading-relaxed">
                                Mulai komunikasi dua arah dengan mengirim pesan di bawah!
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Form Kirim Pesan (Live AJAX) -->
                @if(in_array($sesiKonseling->status, ['menunggu', 'disetujui']))
                    <div class="px-5 sm:px-6 py-4 border-t border-slate-700 bg-slate-800/70">
                        <div id="chat-error-alert" class="hidden mb-3 p-2.5 rounded-lg bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs font-medium"></div>

                        <form id="chat-form" action="{{ route('sesi-konseling.pesan.store', $sesiKonseling->id) }}" method="POST">
                            @csrf
                            <div class="flex gap-3 items-end">
                                <div class="flex-1">
                                    <textarea
                                        id="chat-input"
                                        name="isi"
                                        rows="2"
                                        placeholder="Ketik pesan untuk memulai diskusi..."
                                        class="w-full bg-slate-700/70 border border-slate-600/70 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/30 text-white rounded-xl px-4 py-3 text-sm placeholder-slate-400 transition outline-none resize-none leading-relaxed"
                                    ></textarea>
                                </div>
                                <button type="submit"
                                    id="chat-send-btn"
                                    class="bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white p-3.5 rounded-xl transition shadow-lg shadow-cyan-600/20 shrink-0 group disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg id="send-icon" class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <svg id="send-spinner" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex flex-wrap justify-between items-center mt-2.5 px-1 gap-2 text-[11px] text-slate-400">
                                <div class="flex items-center gap-2.5">
                                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-slate-300 hover:text-white select-none transition">
                                        <input type="checkbox" id="enter-send-toggle" class="rounded bg-slate-700 border-slate-600 text-cyan-500 focus:ring-0 w-3.5 h-3.5 cursor-pointer">
                                        <span>Kirim dengan Enter</span>
                                    </label>
                                    <span id="enter-hint" class="text-slate-500 text-[10px] hidden sm:inline">
                                        (Enter = baris baru, tombol Kirim atau Ctrl + Enter = kirim)
                                    </span>
                                </div>
                                <span id="char-counter" class="text-slate-500 font-mono">0/2000</span>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Sesi sudah selesai / ditolak -->
                    <div class="px-6 py-5 border-t border-slate-700 text-center bg-slate-900/40">
                        <p class="text-slate-400 text-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            Sesi konseling ini telah
                            <span class="font-bold text-white uppercase">{{ $sesiKonseling->status }}</span>.
                            Ruang diskusi telah ditutup.
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Semua Obrolan -->
    <div id="modal-clear-chat" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/70 backdrop-blur-sm p-4 animate-fade-in">
        <div class="bg-slate-800 border border-slate-700 rounded-2xl max-w-md w-full p-6 shadow-2xl relative text-left">
            <div class="w-12 h-12 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <h3 class="text-lg font-bold text-white mb-2">Hapus Semua Obrolan?</h3>
            <p class="text-sm text-slate-300 leading-relaxed mb-6">
                Seluruh riwayat pesan di ruang diskusi sesi ini akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="flex justify-end gap-3">
                <button type="button" id="btn-cancel-clear" class="px-4 py-2 rounded-xl text-sm font-semibold text-slate-300 hover:text-white bg-slate-700 hover:bg-slate-600 transition">
                    Batal
                </button>
                <button type="button" id="btn-confirm-clear" class="px-4 py-2 rounded-xl text-sm font-semibold text-white bg-rose-600 hover:bg-rose-500 transition shadow-lg shadow-rose-600/30 flex items-center gap-2">
                    <span id="clear-btn-text">Ya, Hapus Semua</span>
                    <svg id="clear-btn-spinner" class="hidden w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- ============================================ -->
    <!-- SCRIPT CHAT REALTIME (AJAX + AUTO-POLLING)  -->
    <!-- ============================================ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox      = document.getElementById('chat-messages');
            const chatForm     = document.getElementById('chat-form');
            const chatInput    = document.getElementById('chat-input');
            const sendBtn      = document.getElementById('chat-send-btn');
            const sendIcon     = document.getElementById('send-icon');
            const sendSpinner  = document.getElementById('send-spinner');
            const countBadge   = document.getElementById('chat-count-badge');
            const charCounter  = document.getElementById('char-counter');
            const errorAlert   = document.getElementById('chat-error-alert');

            // Kontrol Enter
            const enterToggle  = document.getElementById('enter-send-toggle');
            const enterHint    = document.getElementById('enter-hint');

            // Kontrol Hapus Obrolan
            const btnClearChat   = document.getElementById('btn-clear-chat');
            const modalClear     = document.getElementById('modal-clear-chat');
            const btnCancelClear = document.getElementById('btn-cancel-clear');
            const btnConfirmClear= document.getElementById('btn-confirm-clear');
            const clearBtnText   = document.getElementById('clear-btn-text');
            const clearBtnSpinner= document.getElementById('clear-btn-spinner');

            const currentUserId   = {{ auth()->id() }};
            const currentUserName = "{{ auth()->user()->name }}";
            const currentUserRole = "{{ auth()->user()->role ?? 'siswa' }}";
            const isUserStaff     = {{ in_array(auth()->user()->role ?? '', ['bk', 'admin']) ? 'true' : 'false' }};
            const sesiId          = {{ $sesiKonseling->id }};
            const postUrl         = "{{ route('sesi-konseling.pesan.store', $sesiKonseling->id) }}";
            const getUrl          = "{{ route('sesi-konseling.pesan.get', $sesiKonseling->id) }}";
            const clearUrl        = "{{ route('sesi-konseling.pesan.clear', $sesiKonseling->id) }}";
            const destroyBaseUrl  = "{{ url('/sesi-konseling/' . $sesiKonseling->id . '/pesan') }}";
            const csrfToken       = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || "{{ csrf_token() }}";

            // Preferensi: Kirim dengan Enter (default: false agar tidak sengaja terkirim saat buat baris baru)
            let enterToSend = localStorage.getItem('ras_enter_send') === 'true';

            function updateEnterHint() {
                if (!enterHint) return;
                if (enterToSend) {
                    enterHint.textContent = '(Enter = langsung kirim, Shift + Enter = baris baru)';
                } else {
                    enterHint.textContent = '(Enter = baris baru, tombol Kirim atau Ctrl + Enter = kirim)';
                }
            }

            if (enterToggle) {
                enterToggle.checked = enterToSend;
                updateEnterHint();
                enterToggle.addEventListener('change', function () {
                    enterToSend = this.checked;
                    localStorage.setItem('ras_enter_send', enterToSend ? 'true' : 'false');
                    updateEnterHint();
                });
            }

            // Hitung ID pesan tertinggi saat pertama kali dimuat
            let lastMessageId = 0;
            const existingRows = document.querySelectorAll('.message-row');
            existingRows.forEach(row => {
                const id = parseInt(row.getAttribute('data-id'), 10);
                if (id > lastMessageId) lastMessageId = id;
            });

            // Scroll ke posisi paling bawah langsung tanpa glitch reset ke atas
            function scrollToBottom() {
                if (!chatBox) return;
                chatBox.scrollTop = chatBox.scrollHeight;
            }
            scrollToBottom();

            // Counter karakter textarea
            if (chatInput && charCounter) {
                chatInput.addEventListener('input', function () {
                    charCounter.textContent = `${this.value.length}/2000`;
                });
            }

            // Penanganan Tombol Keyboard (Enter vs Ctrl+Enter)
            if (chatInput && chatForm) {
                chatInput.addEventListener('keydown', function (e) {
                    // Ctrl + Enter atau Cmd + Enter: selalu kirim
                    if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                        e.preventDefault();
                        chatForm.dispatchEvent(new Event('submit', { cancelable: true }));
                        return;
                    }

                    // Enter biasa tanpa Shift
                    if (e.key === 'Enter' && !e.shiftKey) {
                        if (enterToSend) {
                            e.preventDefault();
                            chatForm.dispatchEvent(new Event('submit', { cancelable: true }));
                        }
                        // Jika enterToSend = false, biarkan membuat baris baru secara alami!
                    }
                });
            }

            // Fungsi render template empty state
            function renderEmptyState() {
                chatBox.innerHTML = `
                    <div id="chat-empty-state" class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="bg-slate-700/50 p-5 rounded-full mb-4 ring-4 ring-slate-800">
                            <svg class="w-9 h-9 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <p class="text-slate-200 font-semibold">Belum ada obrolan</p>
                        <p class="text-slate-400 text-sm mt-1 max-w-xs leading-relaxed">
                            Mulai komunikasi dua arah dengan mengirim pesan di bawah!
                        </p>
                    </div>
                `;
            }

            // Fungsi render bubble pesan ke DOM
            function appendMessage(p) {
                // Jangan buat dobel jika sudah ada
                if (document.querySelector(`.message-row[data-id="${p.id}"]`)) return;

                // Hilangkan empty state jika ada
                const emptyState = document.getElementById('chat-empty-state');
                if (emptyState) emptyState.remove();

                const isMine = p.is_mine;
                const row = document.createElement('div');
                row.className = `flex ${isMine ? 'justify-end' : 'justify-start'} items-end gap-2.5 message-row group animate-fade-in`;
                row.setAttribute('data-id', p.id);

                let badgeHtml = '';
                if (!isMine) {
                    if (p.is_bk) {
                        badgeHtml = '<span class="bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[9px] font-bold px-1.5 py-0.2 rounded-full">Guru BK</span>';
                    } else if (p.is_anonim) {
                        badgeHtml = '<span class="bg-slate-600/30 text-slate-400 border border-slate-600/50 text-[9px] font-bold px-1.5 py-0.2 rounded-full">Anonim</span>';
                    } else {
                        badgeHtml = '<span class="bg-blue-500/20 text-blue-300 border border-blue-500/30 text-[9px] font-bold px-1.5 py-0.2 rounded-full">Siswa</span>';
                    }
                }

                let leftAvatarHtml = '';
                if (!isMine) {
                    const avatarBg = p.is_bk
                        ? 'bg-gradient-to-tr from-emerald-600 to-teal-500 text-white border-emerald-400/40'
                        : (p.is_anonim
                            ? 'bg-slate-700 text-slate-400 border-slate-600'
                            : 'bg-gradient-to-tr from-cyan-600 to-blue-500 text-white border-cyan-400/40');

                    leftAvatarHtml = `
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0 border shadow-sm ${avatarBg}">
                            ${p.avatar_letter || '?'}
                        </div>
                    `;
                }

                let rightAvatarHtml = '';
                if (isMine) {
                    const myLetter = (p.avatar_letter || currentUserName.charAt(0) || 'U').toUpperCase();
                    rightAvatarHtml = `
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white flex items-center justify-center text-xs font-bold shrink-0 border border-blue-400/40 shadow-sm">
                            ${myLetter}
                        </div>
                    `;
                }

                const bubbleBg = isMine
                    ? 'bg-gradient-to-br from-blue-600 to-indigo-600 text-white rounded-2xl rounded-br-sm shadow-md shadow-blue-600/20'
                    : (p.is_bk
                        ? 'bg-slate-700/90 text-slate-100 rounded-2xl rounded-bl-sm border border-emerald-500/30 shadow-sm'
                        : 'bg-slate-700 text-slate-100 rounded-2xl rounded-bl-sm border border-slate-600 shadow-sm');

                const escapedIsi = document.createElement('div');
                escapedIsi.textContent = p.isi;

                // Tombol hapus satuan
                const canDelete = isUserStaff || isMine;
                const deleteBtnHtml = canDelete
                    ? `<button type="button" onclick="deleteSingleMessage(${p.id})" title="Hapus pesan ini" class="opacity-0 group-hover:opacity-100 transition-opacity text-slate-500 hover:text-rose-400 p-0.5 rounded">
                           <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                       </button>`
                    : '';

                row.innerHTML = `
                    ${leftAvatarHtml}
                    <div class="max-w-xs sm:max-w-sm lg:max-w-md">
                        ${!isMine ? `
                            <div class="flex items-center gap-1.5 mb-1 ml-1">
                                <span class="text-xs font-semibold text-slate-300">${p.pengirim_name}</span>
                                ${badgeHtml}
                            </div>
                        ` : ''}
                        <div class="${bubbleBg} px-4 py-3">
                            <p class="text-sm leading-relaxed whitespace-pre-wrap break-words">${escapedIsi.innerHTML}</p>
                        </div>
                        <div class="flex items-center gap-2 mt-1 ${isMine ? 'justify-end mr-1' : 'ml-1'}">
                            <p class="text-[10px] text-slate-500">
                                ${p.created_at} · ${p.time_ago || 'Baru saja'}
                            </p>
                            ${deleteBtnHtml}
                        </div>
                    </div>
                    ${rightAvatarHtml}
                `;

                chatBox.appendChild(row);
                if (p.id > lastMessageId) lastMessageId = p.id;
            }

            // AJAX Form Submit
            if (chatForm) {
                chatForm.addEventListener('submit', async function (e) {
                    e.preventDefault();
                    const text = chatInput.value.trim();
                    if (!text) return;

                    // Loading State
                    sendBtn.disabled = true;
                    if (sendIcon) sendIcon.classList.add('hidden');
                    if (sendSpinner) sendSpinner.classList.remove('hidden');
                    if (errorAlert) errorAlert.classList.add('hidden');

                    try {
                        const response = await fetch(postUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ isi: text })
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            chatInput.value = '';
                            if (charCounter) charCounter.textContent = '0/2000';
                            appendMessage(result.pesan);
                            scrollToBottom();
                            if (countBadge) {
                                const currentTotal = parseInt(countBadge.textContent, 10) || 0;
                                countBadge.textContent = `${currentTotal + 1} pesan`;
                            }
                        } else {
                            if (errorAlert) {
                                errorAlert.textContent = result.message || 'Gagal mengirim pesan. Silakan coba lagi.';
                                errorAlert.classList.remove('hidden');
                            }
                        }
                    } catch (err) {
                        console.error('Chat send error:', err);
                        if (errorAlert) {
                            errorAlert.textContent = 'Terjadi kesalahan jaringan. Periksa koneksi kamu.';
                            errorAlert.classList.remove('hidden');
                        }
                    } finally {
                        sendBtn.disabled = false;
                        if (sendIcon) sendIcon.classList.remove('hidden');
                        if (sendSpinner) sendSpinner.classList.add('hidden');
                        // Prevent page jump when focusing
                        chatInput.focus({ preventScroll: true });
                    }
                });
            }

            // Realtime Auto-Polling (Setiap 2.5 Detik)
            let isPolling = false;
            async function pollNewMessages() {
                if (isPolling) return;
                isPolling = true;

                try {
                    const res = await fetch(`${getUrl}?after_id=${lastMessageId}`, {
                        headers: { 'Accept': 'application/json' }
                    });

                    if (res.ok) {
                        const data = await res.json();

                        // Jika semua pesan dihapus oleh Guru BK
                        if (data.total_pesan === 0) {
                            const existing = document.querySelectorAll('.message-row');
                            if (existing.length > 0) {
                                renderEmptyState();
                                lastMessageId = 0;
                                if (countBadge) countBadge.textContent = '0 pesan';
                            }
                        }

                        // Jika ada pesan baru
                        if (data.pesans && data.pesans.length > 0) {
                            let shouldScroll = false;
                            data.pesans.forEach(p => {
                                appendMessage(p);
                                shouldScroll = true;
                            });
                            if (shouldScroll) scrollToBottom();
                            if (countBadge && data.total_pesan) {
                                countBadge.textContent = `${data.total_pesan} pesan`;
                            }
                        }
                    }
                } catch (err) {
                    // Silent background polling
                } finally {
                    isPolling = false;
                }
            }

            // Jalankan polling berkala
            const pollInterval = setInterval(pollNewMessages, 2500);

            // Modal Hapus Semua Obrolan (Guru BK)
            if (btnClearChat && modalClear) {
                btnClearChat.addEventListener('click', () => {
                    modalClear.classList.remove('hidden');
                });
            }
            if (btnCancelClear && modalClear) {
                btnCancelClear.addEventListener('click', () => {
                    modalClear.classList.add('hidden');
                });
            }
            if (btnConfirmClear) {
                btnConfirmClear.addEventListener('click', async () => {
                    btnConfirmClear.disabled = true;
                    if (clearBtnSpinner) clearBtnSpinner.classList.remove('hidden');
                    if (clearBtnText) clearBtnText.textContent = 'Menghapus...';

                    try {
                        const res = await fetch(clearUrl, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });
                        const data = await res.json();
                        if (res.ok && data.success) {
                            renderEmptyState();
                            lastMessageId = 0;
                            if (countBadge) countBadge.textContent = '0 pesan';
                            modalClear.classList.add('hidden');
                        } else {
                            alert(data.message || 'Gagal menghapus obrolan.');
                        }
                    } catch (err) {
                        alert('Terjadi kesalahan jaringan.');
                    } finally {
                        btnConfirmClear.disabled = false;
                        if (clearBtnSpinner) clearBtnSpinner.classList.add('hidden');
                        if (clearBtnText) clearBtnText.textContent = 'Ya, Hapus Semua';
                    }
                });
            }

            // Fungsi Global: Hapus Satu Pesan
            window.deleteSingleMessage = async function (pesanId) {
                if (!confirm('Hapus pesan ini?')) return;

                try {
                    const res = await fetch(`${destroyBaseUrl}/${pesanId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    const data = await res.json();
                    if (res.ok && data.success) {
                        const row = document.querySelector(`.message-row[data-id="${pesanId}"]`);
                        if (row) {
                            row.remove();
                            // Cek jika habis
                            if (document.querySelectorAll('.message-row').length === 0) {
                                renderEmptyState();
                                lastMessageId = 0;
                            }
                            if (countBadge) {
                                const currentTotal = parseInt(countBadge.textContent, 10) || 1;
                                countBadge.textContent = `${Math.max(0, currentTotal - 1)} pesan`;
                            }
                        }
                    } else {
                        alert(data.message || 'Gagal menghapus pesan.');
                    }
                } catch (err) {
                    alert('Gagal menghapus pesan.');
                }
            };

            // Bersihkan interval saat user meninggalkan halaman
            window.addEventListener('beforeunload', () => clearInterval(pollInterval));
        });
    </script>

</x-app-layout>