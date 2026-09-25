<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <!-- Tombol Kembali -->
            <a href="{{ route('admin.dashboard') }}" class="p-2 bg-slate-800 rounded-xl border border-slate-700 text-slate-400 hover:text-white hover:bg-slate-700 hover:border-slate-500 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-wide">
                {{ __('Manajemen Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Notifikasi Sukses / Error -->
            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-lg mb-6 animate-fade-in-down">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-400 px-6 py-4 rounded-2xl flex items-center gap-4 shadow-lg mb-6 animate-fade-in-down">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Header Tabel & Tombol Tambah -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-800 p-6 rounded-3xl border border-slate-700 shadow-xl">
                <div>
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Daftar Akun Sistem
                    </h3>
                    <p class="text-slate-400 text-sm mt-1">Kelola data login Siswa, Guru BK, dan sesama Admin.</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-500/20 transition-all hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah User Baru
                </a>
            </div>

            <!-- Tabel Data -->
            <div class="bg-slate-800 rounded-3xl shadow-xl border border-slate-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900/50 border-b border-slate-700 text-slate-400 text-xs uppercase tracking-widest font-bold">
                                <th class="px-6 py-5">Nama Pengguna</th>
                                <th class="px-6 py-5">Email</th>
                                <th class="px-6 py-5 text-center">Jabatan / Role</th>
                                <th class="px-6 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse ($users as $user)
                                <tr class="hover:bg-slate-700/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div class="w-11 h-11 rounded-full bg-slate-700 border border-slate-600 flex items-center justify-center text-white font-bold uppercase shadow-inner shrink-0">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-white font-bold group-hover:text-blue-400 transition-colors text-sm sm:text-base">{{ $user->name }}</p>
                                                <p class="text-[11px] text-slate-400 mt-0.5">Dibuat: {{ $user->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-slate-300 text-sm font-medium">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($user->role === 'admin')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-[10px] font-black bg-purple-500/10 text-purple-400 border border-purple-500/20 uppercase tracking-widest shadow-sm">
                                                Admin
                                            </span>
                                        @elseif($user->role === 'bk')
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-[10px] font-black bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 uppercase tracking-widest shadow-sm">
                                                Guru BK
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-[10px] font-black bg-blue-500/10 text-cyan-400 border border-blue-500/20 uppercase tracking-widest shadow-sm">
                                                Siswa
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <!-- Aksi hanya muncul saat row di-hover -->
                                        <div class="flex items-center justify-end gap-2 sm:opacity-0 group-hover:opacity-100 transition-opacity">
                                            
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2.5 bg-amber-500/10 text-amber-400 rounded-xl hover:bg-amber-500 hover:text-white transition-colors border border-amber-500/20 shadow-sm" title="Edit Akun">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            
                                            <!-- Tombol Hapus (Hanya muncul jika bukan akunnya sendiri) -->
                                            @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus akun {{ $user->name }}? Data tidak dapat dikembalikan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2.5 bg-rose-500/10 text-rose-400 rounded-xl hover:bg-rose-500 hover:text-white transition-colors border border-rose-500/20 shadow-sm" title="Hapus Akun">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                            @else
                                            <!-- Mencegah Admin Hapus Akun Sendiri -->
                                            <div class="p-2.5 bg-slate-700/50 text-slate-500 rounded-xl border border-slate-700/50 cursor-not-allowed" title="Anda sedang menggunakan akun ini">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-20 h-20 bg-slate-800 border-2 border-slate-700 rounded-full flex items-center justify-center mb-4 ring-8 ring-slate-900">
                                                <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            </div>
                                            <p class="text-white font-bold text-xl">Belum ada data pengguna</p>
                                            <p class="text-slate-400 text-sm mt-2 max-w-sm">Daftar pengguna yang mendaftar di sistem Ruang Aman Siswa akan tampil di sini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>