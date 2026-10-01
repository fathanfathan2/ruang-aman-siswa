<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Ruang Aman Siswa</title>

    {{-- Gunakan CDN untuk tahap development, ganti ke @vite saat production --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        html, body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        .font-display { font-family: 'Plus Jakarta Sans', 'Inter', ui-sans-serif, sans-serif; }
        .noise-layer {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            opacity: 0.04;
            mix-blend-mode: overlay;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 antialiased">

    <div class="relative min-h-screen w-full overflow-hidden lg:grid lg:grid-cols-[55%_45%] xl:grid-cols-[60%_40%]">

        {{-- ================= LEFT — BRANDING PANEL ================= --}}
        <div class="relative flex min-h-[46vh] flex-col justify-center overflow-hidden border-b border-slate-700 bg-slate-900 px-8 py-12 sm:px-14 lg:min-h-screen lg:border-b-0 lg:border-r lg:px-16 xl:px-24">

            {{-- Ambient Glows --}}
            <div class="pointer-events-none absolute -left-32 -top-40 h-[32rem] w-[32rem] rounded-full bg-blue-600/20 blur-[120px]"></div>
            <div class="pointer-events-none absolute bottom-[-8rem] right-[-6rem] h-[28rem] w-[28rem] rounded-full bg-cyan-400/15 blur-[120px]"></div>
            <div class="noise-layer pointer-events-none absolute inset-0"></div>

            {{-- Motif Jaringan --}}
            <svg class="pointer-events-none absolute inset-0 h-full w-full opacity-40" viewBox="0 0 900 1000" preserveAspectRatio="xMidYMid slice" fill="none">
                <g stroke="url(#gridStroke)" stroke-width="1.5">
                    <path d="M120 860 L 340 700 L 520 760 L 700 560 L 860 610" />
                    <path d="M340 700 L 300 480 L 480 380 L 460 180" />
                    <path d="M520 760 L 620 520 L 480 380" />
                    <path d="M700 560 L 620 520" />
                </g>
                <g fill="#22d3ee">
                    <circle cx="340" cy="700" r="2.5" opacity="0.8" />
                    <circle cx="700" cy="560" r="3.5" opacity="0.9">
                        <animate attributeName="opacity" values="0.3;1;0.3" dur="3s" repeatCount="indefinite" />
                    </circle>
                    <circle cx="480" cy="380" r="3" opacity="0.8" />
                </g>
                <defs>
                    <linearGradient id="gridStroke" x1="0" y1="0" x2="900" y2="1000" gradientUnits="userSpaceOnUse">
                        <stop offset="0%" stop-color="#22d3ee" stop-opacity="0.4" />
                        <stop offset="100%" stop-color="#3b82f6" stop-opacity="0.1" />
                    </linearGradient>
                </defs>
            </svg>

            {{-- Konten Kiri (Logo Besar & Nama) --}}
            <div class="relative z-10 flex flex-col items-start gap-6">
                <!-- Logo Image RAS -->
                <img src="{{ asset('images/logoras.png') }}" 
                     alt="Logo Ruang Aman Siswa" 
                     class="h-24 sm:h-28 w-auto object-contain drop-shadow-xl"
                     onerror="this.outerHTML='<div class=\'h-24 w-24 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl flex items-center justify-center text-white font-bold text-3xl shadow-lg\'>RAS</div>'">

                <!-- Tipografi Raksasa -->
                <h1 class="font-display text-5xl font-extrabold leading-[1.05] tracking-tight text-white sm:text-6xl lg:text-[4.5rem] xl:text-[5rem]">
                    Ruang Aman<br>Siswa.
                </h1>
                
                <p class="mt-2 max-w-md text-base sm:text-lg leading-relaxed text-slate-300 font-medium">
                    Tempat aman untuk terhubung, bercerita, dan berkembang. Laporanmu adalah rahasia kita.
                </p>
            </div>
        </div>

        {{-- ================= RIGHT — LOGIN PANEL ================= --}}
        <div class="relative flex min-h-[54vh] items-center justify-center bg-slate-900/80 px-6 py-12 sm:px-10 lg:min-h-screen lg:px-12">
            
            <div class="pointer-events-none absolute right-[-4rem] top-1/4 h-72 w-72 rounded-full bg-blue-500/10 blur-[100px]"></div>

            <div class="relative z-10 w-full max-w-[420px]" x-data="{ showPassword: false, loading: false }">
                
                {{-- Form Card --}}
                <div class="rounded-3xl border border-slate-700 bg-slate-800 p-8 shadow-2xl sm:p-10">
                    
                    <div class="mb-8 text-center">
                        <h2 class="font-display text-2xl font-bold tracking-tight text-white sm:text-3xl">Selamat Datang </h2>
                        <p class="mt-2 text-sm text-slate-400">Masuk ke akun kamu untuk melanjutkan.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" @submit="loading = true" class="space-y-5">
                        @csrf

                        {{-- Email / NIS (Diperbarui dengan kotak membulat & ramping) --}}
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-slate-300">Email / NIS</label>
                            <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="w-full rounded-xl border-0 bg-slate-100 px-4 py-2.5 text-[15px] font-medium text-slate-900 placeholder:text-slate-500 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-cyan-500"
                                placeholder="Nama@gmail.com" />
                            @error('email') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password (Diperbarui dengan kotak membulat & ramping) --}}
                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-slate-300">Kata Sandi</label>
                            <div class="relative">
                                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                    class="w-full rounded-xl border-0 bg-slate-100 px-4 py-2.5 pr-10 text-[15px] font-medium tracking-wide text-slate-900 placeholder:text-slate-500 outline-none transition-all focus:bg-white focus:ring-2 focus:ring-cyan-500"
                                    placeholder="••••••••" />
                                
                                <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800">
                                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="showPassword" style="display:none;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                            @error('password') <p class="mt-1.5 text-xs text-rose-400">{{ $message }}</p> @enderror
                        </div>

                        {{-- Remember & Lupa Password --}}
                        <div class="flex items-center justify-between pt-1">
                            <label class="flex cursor-pointer select-none items-center gap-2">
                                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-cyan-500 focus:ring-cyan-500 focus:ring-offset-slate-800 transition-colors">
                                <span class="text-sm text-slate-400 hover:text-slate-300">Ingat saya</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-cyan-400 transition-colors hover:text-cyan-300">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>

                        {{-- Tombol Masuk --}}
                        <button type="submit" :disabled="loading" class="mt-2 flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-3.5 text-base font-bold text-white shadow-lg shadow-cyan-500/20 transition-all hover:from-blue-500 hover:to-cyan-400 hover:-translate-y-0.5 active:translate-y-0 disabled:opacity-70 disabled:cursor-not-allowed">
                            <svg x-show="loading" style="display:none;" class="h-5 w-5 animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span x-show="!loading">Masuk ke Ruang Aman</span>
                            <span x-show="loading" style="display:none;">Memproses...</span>
                        </button>
                    </form>

                    {{-- Pemisah ATAU --}}
                    <div class="mt-7 flex items-center gap-4">
                        <div class="h-px flex-1 bg-slate-700"></div>
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-500">Atau</span>
                        <div class="h-px flex-1 bg-slate-700"></div>
                    </div>

                    {{-- Tombol Register --}}
                    <a href="{{ route('register') }}" class="mt-5 flex w-full items-center justify-center rounded-xl border border-slate-600 bg-slate-800/50 px-4 py-3 text-sm font-semibold text-slate-300 transition-colors hover:bg-slate-700 hover:text-white">
                        Daftar Akun Baru
                    </a>

                </div>
            </div>
        </div>
    </div>
</body>
</html>