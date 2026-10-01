<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <!-- Tombol Kembali ke Tabel -->
            <a href="{{ route('admin.users.index') }}" class="p-2 bg-slate-800 rounded-xl border border-slate-700 text-slate-400 hover:text-white hover:bg-slate-700 hover:border-slate-500 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-wide">
                {{ __('Edit Data Pengguna') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-slate-800 rounded-3xl shadow-xl border border-slate-700 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-700 bg-slate-800/50 flex items-center gap-3">
                    <div class="p-2.5 bg-amber-500/10 text-amber-400 rounded-xl border border-amber-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Form Edit Akun</h3>
                        <p class="text-sm text-slate-400">Perbarui informasi pengguna. Kosongkan kolom password jika tidak ingin diubah.</p>
                    </div>
                </div>

                <!-- Form dengan Method PUT (Khusus Update Data) -->
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                        @error('name')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-300 mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                        @error('email')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pilihan Jabatan (Role) -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-slate-300 mb-2">Jabatan (Role Akun)</label>
                        <select name="role" id="role" required
                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all">
                            <option value="siswa" {{ (old('role', $user->role) == 'siswa') ? 'selected' : '' }}>Siswa (Murid)</option>
                            <option value="bk" {{ (old('role', $user->role) == 'bk') ? 'selected' : '' }}>Guru BK (Bimbingan Konseling)</option>
                            <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Administrator (Super Admin)</option>
                        </select>
                        @error('role')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid Password (Opsional) -->
                    <div class="p-6 bg-slate-900/50 rounded-2xl border border-slate-700/50 mt-4 relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-slate-800 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>
                        
                        <div class="flex items-center gap-2 mb-4 relative z-10">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <h4 class="text-sm font-bold text-slate-300">Ubah Password (Opsional)</h4>
                        </div>
                        <p class="text-xs text-slate-400 mb-4 relative z-10">Biarkan kosong jika tidak ingin mengubah password pengguna saat ini.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative z-10">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-xs font-bold text-slate-400 mb-2">Password Baru</label>
                                <input type="password" name="password" id="password"
                                    class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                                    placeholder="Minimal 8 karakter">
                                @error('password')
                                    <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation" class="block text-xs font-bold text-slate-400 mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all"
                                    placeholder="Ulangi password baru">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-slate-700">
                        <a href="{{ route('admin.users.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-slate-700 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-amber-500/20 transition-all hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Update Data
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>