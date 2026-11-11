@php
    $user = auth()->user();
    $dashboardRoute = route('siswa.dashboard');
@endphp

<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Navigation Links (Tanpa Logo) -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="$dashboardRoute" :active="request()->routeIs('siswa.dashboard') || request()->routeIs('bk.dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')" class="text-slate-300 hover:text-white focus:text-white transition-colors">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Custom Profile Dropdown Premium -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                
                <!-- Tombol Trigger -->
                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-slate-800 border border-slate-700 hover:bg-slate-700 transition-colors focus:outline-none shadow-sm">
                    <!-- Avatar Inisial -->
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold text-sm shadow-inner uppercase">
                        {{ substr(Auth::user()?->name ?? 'G', 0, 1) }}
                    </div>
                    <!-- Nama User -->
                    <span class="text-sm font-semibold text-slate-200">{{ Auth::user()?->name ?? 'Guest' }}</span>
                    <!-- Ikon Panah -->
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="{'rotate-180': dropdownOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>

                <!-- Menu Dropdown -->
                <div x-show="dropdownOpen" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
                     class="absolute right-0 top-full mt-3 w-56 rounded-2xl shadow-xl bg-slate-800 border border-slate-700 overflow-hidden z-50"
                     style="display: none;">
                    
                    <!-- Header Menu (Info Role) -->
                    <div class="px-4 py-3 border-b border-slate-700 bg-slate-900/50">
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Login sebagai</p>
                        <p class="text-sm font-bold text-cyan-400 capitalize">{{ Auth::user()?->role ?? 'User' }}</p>
                    </div>

                    <div class="py-1">
                        @if(Auth::user()?->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-cyan-400 hover:bg-slate-700/50 transition-colors">
                                <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Panel Admin
                            </a>
                        @elseif(Auth::user()?->role === 'bk')
                            <a href="{{ route('bk.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-emerald-400 hover:bg-slate-700/50 transition-colors">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                Panel Guru BK
                            </a>
                        @endif

                        <!-- Link Profil -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Pengaturan Profil
                        </a>

                        <!-- Tombol Keluar (Logout) -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 transition-colors border-t border-slate-700/50 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar (Log Out)
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger (Mobile Menu Toggle) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none focus:bg-slate-800 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile View) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900 border-b border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="$dashboardRoute" :active="request()->routeIs('siswa.dashboard') || request()->routeIs('bk.dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')" class="text-slate-300 hover:text-white hover:bg-slate-800">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-800">
            <div class="px-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold shadow-inner uppercase">
                    {{ substr(Auth::user()?->name ?? 'G', 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-slate-200">{{ Auth::user()?->name ?? 'Guest' }}</div>
                    <div class="font-medium text-sm text-slate-400">{{ Auth::user()?->email ?? 'Belum login' }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                @if(Auth::user()?->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" class="text-cyan-400 hover:text-cyan-300 hover:bg-slate-800">
                        {{ __('Panel Admin') }}
                    </x-responsive-nav-link>
                @elseif(Auth::user()?->role === 'bk')
                    <x-responsive-nav-link :href="route('bk.dashboard')" class="text-emerald-400 hover:text-emerald-300 hover:bg-slate-800">
                        {{ __('Panel Guru BK') }}
                    </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('profile.edit')" class="text-slate-300 hover:text-white hover:bg-slate-800">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-rose-400 hover:text-rose-300 hover:bg-slate-800">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>