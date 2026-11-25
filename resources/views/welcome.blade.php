<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Aman Siswa — Layanan Bimbingan Konseling & Pengaduan Sekolah</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-base: #060912;
            --bg-surface: #0b101e;
            --accent-blue: #0a6cff;
        }

        html, body {
            background-color: var(--bg-base);
            color: #f1f5f9;
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            letter-spacing: -0.011em;
        }

        .font-display {
            font-family: 'Plus Jakarta Sans', 'Inter', ui-sans-serif, sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', ui-monospace, SFMono-Regular, monospace;
        }

        /* Tekstur film grain halus (selaras dengan halaman login) */
        .grain-overlay {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            opacity: 0.035;
            mix-blend-mode: overlay;
        }

        /* Garis arsitektural tipis dengan radial mask */
        .arch-grid {
            background-size: 56px 56px;
            background-image:
                linear-gradient(to right, rgba(255, 255, 255, 0.028) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.028) 1px, transparent 1px);
            mask-image: radial-gradient(ellipse 80% 60% at 50% 18%, #000 35%, transparent 100%);
            -webkit-mask-image: radial-gradient(ellipse 80% 60% at 50% 18%, #000 35%, transparent 100%);
        }

        /* Kartu Bento dengan kilau tepi atas & spotlight kursor */
        .bento-card {
            position: relative;
            background: linear-gradient(180deg, rgba(17, 24, 42, 0.78) 0%, rgba(10, 15, 28, 0.92) 100%);
            border: 1px solid rgba(255, 255, 255, 0.07);
            box-shadow: inset 0 1px 0 0 rgba(255, 255, 255, 0.07), 0 20px 40px -24px rgba(0, 0, 0, 0.7);
            overflow: hidden;
            transition: border-color 0.35s cubic-bezier(0.16, 1, 0.3, 1), transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .bento-card:hover {
            border-color: rgba(56, 139, 253, 0.28);
        }

        .bento-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(
                520px circle at var(--mouse-x, -500px) var(--mouse-y, -500px),
                rgba(10, 108, 255, 0.12),
                transparent 45%
            );
            pointer-events: none;
            z-index: 1;
        }

        /* Animasi masuk bertahap (Blur to Sharp + Lift) */
        .reveal {
            opacity: 0;
            transform: translateY(22px);
            filter: blur(5px);
            transition:
                opacity 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                transform 0.75s cubic-bezier(0.16, 1, 0.3, 1),
                filter 0.75s cubic-bezier(0.16, 1, 0.3, 1);
            transition-delay: var(--delay, 0ms);
        }

        .reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }

        /* Indikator mengetik halus */
        @keyframes dotBlink {
            0%, 80%, 100% { opacity: 0.25; transform: translateY(0); }
            40% { opacity: 1; transform: translateY(-2px); }
        }
        .typing-dot:nth-child(1) { animation: dotBlink 1.3s infinite 0s; }
        .typing-dot:nth-child(2) { animation: dotBlink 1.3s infinite 0.18s; }
        .typing-dot:nth-child(3) { animation: dotBlink 1.3s infinite 0.36s; }

        /* Transisi Akordeon FAQ */
        .faq-content {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.32s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .faq-item.open .faq-content {
            grid-template-rows: 1fr;
        }
        .faq-item.open .faq-icon {
            transform: rotate(45deg);
        }
    </style>
</head>
<body class="min-h-screen antialiased selection:bg-blue-600/40 selection:text-white relative overflow-x-hidden">

    <!-- Tekstur Latar & Cahaya Atmosferik Tunggal -->
    <div class="grain-overlay pointer-events-none fixed inset-0 z-50"></div>
    <div class="arch-grid pointer-events-none absolute inset-x-0 top-0 h-[760px] z-0"></div>
    <div class="pointer-events-none absolute left-1/2 -top-56 -translate-x-1/2 w-[820px] h-[420px] rounded-full bg-blue-600/12 blur-[130px] z-0"></div>

    <!-- ================= 1. NAVBAR ================= -->
    <header id="navbar" class="sticky top-0 z-40 transition-all duration-300 border-b border-transparent">
        <div class="max-w-6xl mx-auto px-5 sm:px-8 h-16 flex items-center justify-between">
            
            <!-- Identitas Logo RAS -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-lg bg-slate-900/90 border border-white/10 flex items-center justify-center p-1.5 shadow-inner transition-transform duration-300 group-hover:scale-105">
                    <img src="{{ asset('images/logoras.png') }}"
                         alt="Logo Ruang Aman Siswa"
                         class="w-full h-full object-contain"
                         onerror="this.outerHTML='<span class=\'text-xs font-bold text-blue-400\'>RAS</span>'">
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="font-display text-[15px] font-bold tracking-tight text-white">Ruang Aman Siswa</span>
                </div>
            </a>

            <!-- Navigasi Editorial -->
            <nav class="hidden md:flex items-center gap-7 text-[13px] text-slate-400">
                <a href="#fitur" class="hover:text-white transition-colors">Layanan</a>
                <a href="#alur-kerja" class="hover:text-white transition-colors">Cara Kerja</a>
                <a href="#tanya-jawab" class="hover:text-white transition-colors">Privasi & FAQ</a>
            </nav>

            <!-- Tombol Aksi Berdasarkan Status Login -->
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="group inline-flex items-center gap-2 px-4 py-2 rounded-lg text-[13px] font-semibold bg-white text-slate-950 hover:bg-slate-100 transition-all shadow-sm active:scale-[0.98]">
                        <span>Buka Dashboard</span>
                        <svg class="w-3.5 h-3.5 text-slate-600 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                @else
                    <a href="#alur-kerja" class="hidden sm:inline-flex px-3.5 py-1.5 text-[13px] text-slate-300 hover:text-white transition-colors">
                        Panduan Siswa
                    </a>
                    <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 px-4 py-2 rounded-lg text-[13px] font-semibold bg-white text-slate-950 hover:bg-slate-100 transition-all shadow-sm active:scale-[0.98]">
                        <span>Masuk Akun</span>
                        <svg class="w-3.5 h-3.5 text-slate-600 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                @endauth
            </div>

        </div>
    </header>

    <!-- ================= 2. HERO SECTION ASIMETRIS ================= -->
    <section class="relative z-10 pt-14 pb-20 sm:pt-20 sm:pb-28 max-w-6xl mx-auto px-5 sm:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">
            
            <!-- Kolom Kiri: Copywriting Utama (7 Kolom) -->
            <div class="lg:col-span-7 space-y-7">
                
                <div class="reveal is-visible inline-flex items-center gap-2.5 px-3 py-1 rounded-full bg-white/[0.03] border border-white/[0.08] text-xs text-slate-300" style="--delay: 40ms">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                    <span>Layanan Bimbingan Konseling & Pengaduan Internal Sekolah</span>
                </div>

                <h1 class="reveal is-visible font-display text-4xl sm:text-[52px] font-extrabold tracking-[-0.035em] leading-[1.08] text-white" style="--delay: 120ms">
                    Cerita dengan tenang.<br>
                    <span class="text-slate-400 font-bold">Identitasmu tetap milikmu.</span>
                </h1>

                <p class="reveal is-visible text-[15px] sm:text-base text-slate-400 leading-[1.7] max-w-xl" style="--delay: 200ms">
                    Tidak semua hal mudah diceritakan secara langsung di ruang guru. Melalui Ruang Aman Siswa, kamu bisa menjadwalkan sesi empat mata bersama Guru BK atau mengirim laporan kejadian tanpa mencantumkan nama.
                </p>

                <!-- Tombol Utama Sebelum Login -->
                <div class="reveal is-visible flex flex-wrap items-center gap-3.5 pt-1" style="--delay: 280ms">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl text-sm font-semibold bg-[#0A6CFF] hover:bg-blue-500 text-white shadow-[0_0_0_1px_rgba(255,255,255,0.12)_inset,0_10px_28px_-8px_rgba(10,108,255,0.55)] transition-all hover:-translate-y-0.5 active:translate-y-0">
                            <span>Lanjutkan ke Dashboard</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2.5 px-5 py-3 rounded-xl text-sm font-semibold bg-[#0A6CFF] hover:bg-blue-500 text-white shadow-[0_0_0_1px_rgba(255,255,255,0.12)_inset,0_10px_28px_-8px_rgba(10,108,255,0.55)] transition-all hover:-translate-y-0.5 active:translate-y-0">
                            <span>Masuk & Mulai Cerita</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @endauth

                    <a href="#tanya-jawab" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-medium text-slate-300 hover:text-white bg-white/[0.03] hover:bg-white/[0.06] border border-white/[0.08] transition-all">
                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                        <span>Cara Kami Menjaga Privasi</span>
                    </a>
                </div>

                <!-- Catatan Kaki Kepercayaan -->
                <div class="reveal is-visible pt-6 border-t border-white/[0.06] flex flex-wrap items-center gap-x-8 gap-y-3 text-xs text-slate-500" style="--delay: 360ms">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Hanya diakses Guru BK berwenang</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                        </svg>
                        <span>Mode laporan tanpa nama tersedia</span>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Simulasi Antarmuka Interaktif (5 Kolom) -->
            <div class="lg:col-span-5 reveal is-visible" style="--delay: 240ms">
                <div class="bento-card rounded-2xl p-1">
                    <div class="rounded-[14px] bg-[#080C17] border border-white/[0.05] p-5 space-y-4 relative z-10">
                        
                        <!-- Pemilih Mode Simulasi -->
                        <div class="flex items-center justify-between gap-2 pb-3.5 border-b border-white/[0.06]">
                            <div class="inline-flex p-0.5 rounded-lg bg-slate-900 border border-white/[0.06] text-xs">
                                <button type="button" id="tab-konseling" onclick="switchWorkspaceTab('konseling')" class="px-3 py-1.5 rounded-md font-medium transition-all bg-white/[0.09] text-white shadow-sm">
                                    Diskusi BK
                                </button>
                                <button type="button" id="tab-lapor" onclick="switchWorkspaceTab('lapor')" class="px-3 py-1.5 rounded-md font-medium transition-all text-slate-400 hover:text-slate-200">
                                    Lapor Kejadian
                                </button>
                            </div>

                            <!-- Tombol Simulasi Penyamaran Identitas -->
                            <button type="button" id="anon-toggle-btn" onclick="toggleHeroAnon()" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-mono border transition-all bg-blue-500/10 text-blue-300 border-blue-500/25 hover:bg-blue-500/15" title="Klik untuk mencoba simulasi penyamaran nama">
                                <span id="anon-dot" class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                <span id="anon-state-label">Anonim: Aktif</span>
                            </button>
                        </div>

                        <!-- Baris Status Identitas Pengirim -->
                        <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-slate-900/70 border border-white/[0.05] text-xs">
                            <span class="text-slate-500">Pengirim terlihat sebagai:</span>
                            <span id="sender-cipher" class="font-mono font-medium text-slate-200 tracking-tight">Siswa Anonim • #RAS-409</span>
                        </div>

                        <!-- Panel 1: Simulasi Diskusi BK -->
                        <div id="panel-konseling" class="space-y-3.5 pt-1 transition-all duration-300">
                            <div class="space-y-1">
                                <div class="flex items-center justify-between text-[11px] text-slate-500 px-1">
                                    <span>Topik: Tekanan Belajar & Pertemanan</span>
                                    <span class="font-mono">14:12 WIB</span>
                                </div>
                                <div class="p-3.5 rounded-xl bg-slate-900/90 border border-white/[0.06] text-[13px] text-slate-300 leading-relaxed">
                                    Bu, akhir-akhir ini saya sering merasa tertekan di kelas tapi bingung harus cerita ke siapa supaya tidak menyebar ke teman lain.
                                </div>
                            </div>

                            <div class="pl-5 space-y-1.5">
                                <div class="flex items-center gap-2 text-[11px] text-slate-400 px-1">
                                    <span class="w-4 h-4 rounded-full bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-[9px] font-bold text-blue-300">BK</span>
                                    <span class="font-medium text-slate-300">Guru BK Pembimbing</span>
                                    <span class="text-emerald-400/90 text-[10px]">• Terverifikasi</span>
                                </div>
                                <div class="p-3.5 rounded-xl bg-[#0B1933] border border-blue-500/20 text-[13px] text-slate-200 leading-relaxed">
                                    Terima kasih sudah menghubungi Ibu ya. Percakapan di ruang ini tertutup. Kita bisa bahas pelan-pelan lewat chat ini atau atur jadwal temu saat jam istirahat.
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-2 text-[11px] text-slate-500">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex gap-0.5 items-center px-2 py-1 rounded bg-white/[0.03] border border-white/[0.05]">
                                        <span class="w-1 h-1 rounded-full bg-slate-400 typing-dot"></span>
                                        <span class="w-1 h-1 rounded-full bg-slate-400 typing-dot"></span>
                                        <span class="w-1 h-1 rounded-full bg-slate-400 typing-dot"></span>
                                    </span>
                                    <span>Ruang diskusi dua arah aktif</span>
                                </div>
                                <span class="font-mono text-[10px] text-slate-600">Enter ↵ kirim</span>
                            </div>
                        </div>

                        <!-- Panel 2: Simulasi Lapor Kejadian -->
                        <div id="panel-lapor" class="hidden space-y-3 pt-1 transition-all duration-300">
                            <div class="p-3.5 rounded-xl bg-slate-900/90 border border-white/[0.06] space-y-2.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] font-medium px-2 py-0.5 rounded bg-amber-500/10 text-amber-300 border border-amber-500/20">Perundungan Verbal</span>
                                    <span class="text-[11px] font-mono text-slate-500">Baru saja</span>
                                </div>
                                <p class="text-[13px] font-medium text-white">Kejadian di area koridor lantai 2 saat jam istirahat</p>
                                <p class="text-xs text-slate-400 leading-relaxed">
                                    Laporan diterima langsung oleh koordinator Guru BK tanpa menampilkan nama pelapor pada daftar riwayat umum.
                                </p>
                            </div>
                            <div class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-emerald-500/[0.06] border border-emerald-500/20 text-xs">
                                <span class="text-slate-300">Status Tindak Lanjut</span>
                                <span class="font-medium text-emerald-400">Sedang Ditinjau BK</span>
                            </div>
                        </div>

                    </div>
                </div>
                <p class="text-center text-[11px] text-slate-500 mt-3">
                    Klik tombol <span class="text-slate-300 font-mono">Anonim: Aktif</span> atau tab di atas untuk mencoba simulasi.
                </p>
            </div>

        </div>
    </section>

    <!-- ================= 3. BENTO GRID ASIMETRIS (LAYANAN UTAMA) ================= -->
    <section id="fitur" class="relative z-10 py-20 max-w-6xl mx-auto px-5 sm:px-8 border-t border-white/[0.06]">
        
        <div class="reveal max-w-2xl mb-12 space-y-3">
            <p class="text-xs font-mono uppercase tracking-widest text-blue-400">Empat Ruang Utama</p>
            <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-white">
                Dirancang sesuai kebutuhan nyata di sekolah.
            </h2>
            <p class="text-sm text-slate-400 leading-relaxed">
                Bukan sekadar kotak saran pasif. Setiap fitur terhubung langsung dengan alur kerja Guru BK agar setiap cerita mendapat tindak lanjut yang jelas.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
            
            <!-- Bento 1 (7 Kolom): Pelaporan dengan Kendali Privasi -->
            <div class="bento-card reveal lg:col-span-7 rounded-2xl p-6 sm:p-8 flex flex-col justify-between gap-8">
                <div class="relative z-10 space-y-3 max-w-lg">
                    <div class="w-9 h-9 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-lg font-bold text-white tracking-tight">Pelaporan Kejadian dengan Kendali Privasi</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Laporkan perundungan, kerusakan fasilitas, atau pelanggaran tata tertib. Kamu memegang kendali penuh untuk mencantumkan nama atau mengirimkannya secara anonim.
                    </p>
                </div>

                <div class="relative z-10 rounded-xl bg-[#070A13] border border-white/[0.06] p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1">
                        <p class="text-xs font-medium text-slate-200">Kirim sebagai Anonim</p>
                        <p class="text-[11px] text-slate-500">Nama akun siswa disembunyikan dari daftar laporan Guru BK.</p>
                    </div>
                    <div class="flex items-center gap-2.5 shrink-0">
                        <span class="px-2.5 py-1 rounded text-[11px] font-mono bg-white/[0.04] text-slate-300 border border-white/[0.06]">
                            kategori: bullying
                        </span>
                        <span class="px-2.5 py-1 rounded text-[11px] font-mono bg-blue-500/15 text-blue-300 border border-blue-500/30">
                            is_anonim: true
                        </span>
                    </div>
                </div>
            </div>

            <!-- Bento 2 (5 Kolom): Ruang Diskusi Dua Arah -->
            <div class="bento-card reveal lg:col-span-5 rounded-2xl p-6 sm:p-8 flex flex-col justify-between gap-6" style="--delay: 80ms">
                <div class="relative z-10 space-y-3">
                    <div class="w-9 h-9 rounded-lg bg-white/[0.05] border border-white/[0.1] flex items-center justify-center text-slate-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-lg font-bold text-white tracking-tight">Ruang Diskusi Konseling Live</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Tanya jawab dua arah yang langsung diperbarui otomatis di layar tanpa perlu memuat ulang halaman.
                    </p>
                </div>

                <div class="relative z-10 space-y-2 rounded-xl bg-[#070A13] border border-white/[0.06] p-3.5 text-xs">
                    <div class="flex items-center justify-between text-[11px] text-slate-500 pb-1.5 border-b border-white/[0.05]">
                        <span>Catatan Balasan BK</span>
                        <span class="text-emerald-400 flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Aktif</span>
                    </div>
                    <p class="text-slate-300 leading-relaxed pt-1">
                        "Jadwal konselingmu sudah Ibu setujui untuk Kamis jam istirahat pertama ya."
                    </p>
                </div>
            </div>

            <!-- Bento 3 (5 Kolom): Booking Jadwal Konseling -->
            <div class="bento-card reveal lg:col-span-5 rounded-2xl p-6 sm:p-8 flex flex-col justify-between gap-6">
                <div class="relative z-10 space-y-3">
                    <div class="w-9 h-9 rounded-lg bg-white/[0.05] border border-white/[0.1] flex items-center justify-center text-slate-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-lg font-bold text-white tracking-tight">Booking Jadwal Tanpa Antre</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Pilih sendiri tanggal dan jam pertemuan yang tidak mengganggu jam pelajaran di kelasmu.
                    </p>
                </div>

                <div class="relative z-10 grid grid-cols-2 gap-2 text-xs">
                    <button type="button" onclick="selectSlot(this)" class="slot-btn px-3 py-2 rounded-lg border text-left transition-all bg-blue-600/15 border-blue-500/40 text-white">
                        <span class="block font-medium">Kamis, 09:45</span>
                        <span class="text-[10px] text-blue-300">Istirahat 1 • Tersedia</span>
                    </button>
                    <button type="button" onclick="selectSlot(this)" class="slot-btn px-3 py-2 rounded-lg border text-left transition-all bg-[#070A13] border-white/[0.06] text-slate-400 hover:text-slate-200">
                        <span class="block font-medium">Jumat, 13:00</span>
                        <span class="text-[10px] text-slate-500">Sepulang Sekolah</span>
                    </button>
                </div>
            </div>

            <!-- Bento 4 (7 Kolom): Rekam Jejak Pembinaan -->
            <div class="bento-card reveal lg:col-span-7 rounded-2xl p-6 sm:p-8 flex flex-col justify-between gap-6" style="--delay: 80ms">
                <div class="relative z-10 space-y-3 max-w-lg">
                    <div class="w-9 h-9 rounded-lg bg-white/[0.05] border border-white/[0.1] flex items-center justify-center text-slate-200">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-lg font-bold text-white tracking-tight">Rekam Jejak Poin & Pembinaan yang Adil</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Setiap riwayat laporan, status penanganan Guru BK, hingga catatan ketertiban terdokumentasi rapi di dashboard siswa secara objektif.
                    </p>
                </div>

                <div class="relative z-10 grid grid-cols-3 gap-3 rounded-xl bg-[#070A13] border border-white/[0.06] p-4 text-xs">
                    <div>
                        <span class="text-slate-500 block text-[11px]">Status Laporan</span>
                        <span class="text-white font-medium mt-0.5 block">Terpantau Real-time</span>
                    </div>
                    <div class="border-l border-white/[0.06] pl-3">
                        <span class="text-slate-500 block text-[11px]">Akses Portal</span>
                        <span class="text-white font-medium mt-0.5 block">Siswa, BK & Admin</span>
                    </div>
                    <div class="border-l border-white/[0.06] pl-3">
                        <span class="text-slate-500 block text-[11px]">Pendekatan</span>
                        <span class="text-blue-400 font-medium mt-0.5 block">Edukatif & Solutif</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= 4. ALUR PENGGUNAAN (TIMELINE EDITORIAL) ================= -->
    <section id="alur-kerja" class="relative z-10 py-20 max-w-6xl mx-auto px-5 sm:px-8 border-t border-white/[0.06]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <div class="lg:col-span-4 reveal space-y-3">
                <p class="text-xs font-mono uppercase tracking-widest text-slate-500">Alur Penggunaan</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-white">
                    Tiga langkah dari cerita menuju solusi.
                </h2>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Tidak perlu birokrasi berbelit. Semua proses dirancang supaya siswa merasa didampingi sejak menit pertama melapor.
                </p>
            </div>

            <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="reveal space-y-3 pt-4 border-t border-white/15" style="--delay: 60ms">
                    <span class="font-mono text-xs text-blue-400">01</span>
                    <h3 class="font-display text-base font-bold text-white">Masuk Portal Siswa</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Klik tombol Masuk Akun dan gunakan email atau NIS resmi dari sekolah untuk membuka dashboard pribadimu.
                    </p>
                </div>

                <div class="reveal space-y-3 pt-4 border-t border-white/15" style="--delay: 140ms">
                    <span class="font-mono text-xs text-blue-400">02</span>
                    <h3 class="font-display text-base font-bold text-white">Tulis Laporan / Jadwal</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Pilih kategori masalah atau tanggal konseling. Aktifkan mode anonim bila belum siap menampilkan nama.
                    </p>
                </div>

                <div class="reveal space-y-3 pt-4 border-t border-white/15" style="--delay: 220ms">
                    <span class="font-mono text-xs text-blue-400">03</span>
                    <h3 class="font-display text-base font-bold text-white">Tanggapan Guru BK</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Guru BK memverifikasi pengajuanmu, memberi catatan balasan, atau membuka ruang diskusi dua arah.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= 5. PRIVASI & TANYA JAWAB (ACCORDION) ================= -->
    <section id="tanya-jawab" class="relative z-10 py-20 max-w-4xl mx-auto px-5 sm:px-8 border-t border-white/[0.06]">
        <div class="reveal mb-10 space-y-2">
            <p class="text-xs font-mono uppercase tracking-widest text-blue-400">Privasi & Pertanyaan Umum</p>
            <h2 class="font-display text-2xl font-bold tracking-tight text-white">Hal yang sering ditanyakan siswa</h2>
        </div>

        <div class="divide-y divide-white/[0.07] border-y border-white/[0.07]">
            
            <div class="faq-item open py-4">
                <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left gap-4 py-1 text-sm font-medium text-white hover:text-blue-300 transition-colors">
                    <span>Apakah teman sekelas bisa melihat laporan atau jadwal konseling saya?</span>
                    <span class="faq-icon text-slate-400 transition-transform duration-300 text-lg leading-none">+</span>
                </button>
                <div class="faq-content">
                    <div class="overflow-hidden">
                        <p class="pt-2.5 pb-1 text-xs sm:text-sm text-slate-400 leading-relaxed">
                            Tidak sama sekali. Setiap akun siswa hanya menampilkan riwayat miliknya sendiri. Laporan dan ruang chat hanya dapat dibuka oleh akun Guru BK yang bertugas menangani bimbingan di sekolah.
                        </p>
                    </div>
                </div>
            </div>

            <div class="faq-item py-4">
                <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left gap-4 py-1 text-sm font-medium text-white hover:text-blue-300 transition-colors">
                    <span>Bagaimana cara kerja fitur "Kirim sebagai Anonim"?</span>
                    <span class="faq-icon text-slate-400 transition-transform duration-300 text-lg leading-none">+</span>
                </button>
                <div class="faq-content">
                    <div class="overflow-hidden">
                        <p class="pt-2.5 pb-1 text-xs sm:text-sm text-slate-400 leading-relaxed">
                            Saat opsi anonim diaktifkan pada laporan maupun sesi konseling, antarmuka Guru BK otomatis menyamarkan nama dan inisial profilmu menjadi label Anonim sehingga fokus penanganan murni pada penyelesaian masalahnya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="faq-item py-4">
                <button type="button" onclick="toggleFaq(this)" class="w-full flex items-center justify-between text-left gap-4 py-1 text-sm font-medium text-white hover:text-blue-300 transition-colors">
                    <span>Bagaimana jika saya belum memiliki akun untuk login?</span>
                    <span class="faq-icon text-slate-400 transition-transform duration-300 text-lg leading-none">+</span>
                </button>
                <div class="faq-content">
                    <div class="overflow-hidden">
                        <p class="pt-2.5 pb-1 text-xs sm:text-sm text-slate-400 leading-relaxed">
                            Demi mencegah akun palsu dari luar sekolah, pembuatan akun dikelola langsung oleh Admin Sekolah / Ruang BK. Hubungi staf BK atau operator sekolah untuk mendapatkan akses login siswa.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ================= 6. CALL TO ACTION PENUTUP & FOOTER ================= -->
    <section class="relative z-10 py-16 max-w-6xl mx-auto px-5 sm:px-8">
        <div class="bento-card reveal rounded-3xl p-8 sm:p-12 flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
            <div class="relative z-10 space-y-2 max-w-xl">
                <h3 class="font-display text-2xl sm:text-3xl font-bold tracking-tight text-white">
                    Siap bercerita hari ini?
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Masuk ke Ruang Aman Siswa dan sampaikan hal yang mengganjal pikiranmu dengan tenang.
                </p>
            </div>
            <div class="relative z-10 flex items-center gap-3 shrink-0">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl text-sm font-semibold bg-white text-slate-950 hover:bg-slate-100 transition-all shadow-lg active:scale-[0.98]">
                        <span>Buka Dashboard Saya</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl text-sm font-semibold bg-white text-slate-950 hover:bg-slate-100 transition-all shadow-lg active:scale-[0.98]">
                        <span>Masuk ke Ruang Aman</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <footer class="relative z-10 border-t border-white/[0.06] py-8 max-w-6xl mx-auto px-5 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
        <div class="flex items-center gap-2.5">
            <img src="{{ asset('images/logoras.png') }}" alt="RAS" class="h-4 w-auto opacity-80" onerror="this.style.display='none'">
            <span class="font-medium text-slate-300">Ruang Aman Siswa</span>
            <span>•</span>
            <span>Layanan Bimbingan Konseling Sekolah</span>
        </div>
        <p>© {{ date('Y') }} Ruang Aman Siswa. Privasi siswa dilindungi.</p>
    </footer>

    <!-- ================= INTERACTIVE SCRIPTS & ANIMATIONS ================= -->
    <script>
        // 1. Efek Transisi Blur Navbar Saat Scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 16) {
                navbar.classList.add('bg-[#060912]/85', 'backdrop-blur-md', 'border-white/[0.07]');
                navbar.classList.remove('border-transparent');
            } else {
                navbar.classList.remove('bg-[#060912]/85', 'backdrop-blur-md', 'border-white/[0.07]');
                navbar.classList.add('border-transparent');
            }
        }, { passive: true });

        // 2. Scroll-Triggered Staggered Reveal (IntersectionObserver)
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.14 });

        document.querySelectorAll('.reveal:not(.is-visible)').forEach((el) => observer.observe(el));

        // 3. Cursor-Tracking Radial Spotlight pada Kartu Bento
        document.querySelectorAll('.bento-card').forEach((card) => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                card.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                card.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
            card.addEventListener('mouseleave', () => {
                card.style.setProperty('--mouse-x', `-500px`);
                card.style.setProperty('--mouse-y', `-500px`);
            });
        });

        // 4. Animasi Cipher Scramble Saat Toggle Mode Anonim
        let isAnon = true;
        const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ0123456789#';
        let scrambleTimer = null;

        function scrambleText(el, targetText) {
            let iteration = 0;
            clearInterval(scrambleTimer);
            scrambleTimer = setInterval(() => {
                el.textContent = targetText
                    .split('')
                    .map((char, idx) => {
                        if (char === ' ' || char === '•') return char;
                        if (idx < iteration) return targetText[idx];
                        return chars[Math.floor(Math.random() * chars.length)];
                    })
                    .join('');
                iteration += 1.2;
                if (iteration >= targetText.length) {
                    el.textContent = targetText;
                    clearInterval(scrambleTimer);
                }
            }, 24);
        }

        function toggleHeroAnon() {
            isAnon = !isAnon;
            const cipherEl = document.getElementById('sender-cipher');
            const labelEl = document.getElementById('anon-state-label');
            const btnEl = document.getElementById('anon-toggle-btn');
            const dotEl = document.getElementById('anon-dot');

            if (isAnon) {
                labelEl.textContent = 'Anonim: Aktif';
                btnEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-mono border transition-all bg-blue-500/10 text-blue-300 border-blue-500/25 hover:bg-blue-500/15';
                dotEl.className = 'w-1.5 h-1.5 rounded-full bg-blue-400';
                scrambleText(cipherEl, 'Siswa Anonim • #RAS-409');
            } else {
                labelEl.textContent = 'Mode: Terbuka';
                btnEl.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[11px] font-mono border transition-all bg-white/[0.05] text-slate-300 border-white/10 hover:bg-white/10';
                dotEl.className = 'w-1.5 h-1.5 rounded-full bg-emerald-400';
                scrambleText(cipherEl, 'Nadia Putri • XI MIPA 2');
            }
        }

        // 5. Tab Switcher di Kartu Hero
        function switchWorkspaceTab(tab) {
            const tabK = document.getElementById('tab-konseling');
            const tabL = document.getElementById('tab-lapor');
            const panelK = document.getElementById('panel-konseling');
            const panelL = document.getElementById('panel-lapor');

            if (tab === 'konseling') {
                tabK.className = 'px-3 py-1.5 rounded-md font-medium transition-all bg-white/[0.09] text-white shadow-sm';
                tabL.className = 'px-3 py-1.5 rounded-md font-medium transition-all text-slate-400 hover:text-slate-200';
                panelL.classList.add('hidden');
                panelK.classList.remove('hidden');
            } else {
                tabL.className = 'px-3 py-1.5 rounded-md font-medium transition-all bg-white/[0.09] text-white shadow-sm';
                tabK.className = 'px-3 py-1.5 rounded-md font-medium transition-all text-slate-400 hover:text-slate-200';
                panelK.classList.add('hidden');
                panelL.classList.remove('hidden');
            }
        }

        // 6. Pemilih Slot Waktu Interaktif
        function selectSlot(clickedBtn) {
            document.querySelectorAll('.slot-btn').forEach((btn) => {
                btn.className = 'slot-btn px-3 py-2 rounded-lg border text-left transition-all bg-[#070A13] border-white/[0.06] text-slate-400 hover:text-slate-200';
                btn.querySelector('span:last-child').className = 'text-[10px] text-slate-500';
            });
            clickedBtn.className = 'slot-btn px-3 py-2 rounded-lg border text-left transition-all bg-blue-600/15 border-blue-500/40 text-white';
            clickedBtn.querySelector('span:last-child').className = 'text-[10px] text-blue-300';
        }

        // 7. Akordeon FAQ Halus
        function toggleFaq(btn) {
            const item = btn.closest('.faq-item');
            const wasOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach((el) => el.classList.remove('open'));
            if (!wasOpen) item.classList.add('open');
        }
    </script>
</body>
</html>
