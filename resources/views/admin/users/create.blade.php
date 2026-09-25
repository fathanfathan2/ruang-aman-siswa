<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <!-- Tombol Kembali ke Tabel -->
            <a href="{{ route('admin.users.index') }}" class="p-2 bg-slate-800 rounded-xl border border-slate-700 text-slate-400 hover:text-white hover:bg-slate-700 hover:border-slate-500 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight tracking-wide">
                {{ __('Tambah User Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-slate-800 rounded-3xl shadow-xl border border-slate-700 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-700 bg-slate-800/50 flex items-center gap-3">
                    <div class="p-2.5 bg-blue-500/10 text-blue-400 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Form Registrasi Akun</h3>
                        <p class="text-sm text-slate-400">Pastikan email yang didaftarkan belum pernah digunakan.</p>
                    </div>
                </div>

                <form action="{{ route('admin.users.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="Nama Lengkap">
                        @error('name')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-300 mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="Contoh: email@gmail.com">
                        @error('email')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pilihan Jabatan (Role) -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-slate-300 mb-2">Jabatan (Role Akun)</label>
                        <select name="role" id="role" required
                            class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="" disabled selected>-- Pilih Hak Akses Pengguna --</option>
                            <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa (Murid)</option>
                            <option value="bk" {{ old('role') == 'bk' ? 'selected' : '' }}>Guru BK (Bimbingan Konseling)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator (Super Admin)</option>
                        </select>
                        @error('role')
                            <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid Password -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-300 mb-2">Password Baru</label>
                            <input type="password" name="password" id="password" required
                                class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Minimal 8 karakter">
                            @error('password')
                                <p class="text-rose-400 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-300 mb-2">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full bg-slate-900 border border-slate-700 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Ulangi password di atas">
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-slate-700">
                        <button type="reset" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-white hover:bg-slate-700 transition-colors">
                            Reset Form
                        </button>
                        <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-500/20 transition-all hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Pengguna
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>