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
            
            <!-- Banner Header Form (Gradient Rose-Pink untuk Pelanggaran) -->
            <div class="bg-gradient-to-r from-rose-500 to-pink-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white relative overflow-hidden flex justify-between items-center">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold tracking-wide">Catat Poin Kedisiplinan</h3>
                    <p class="text-rose-100 text-sm mt-1">Pilih siswa dan jenis pelanggaran untuk mencatat poin baru.</p>
                </div>
                <!-- Icon Dekoratif -->
                <div class="relative z-10 hidden sm:block opacity-80">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Card Form Utama (Slate 800) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-700">

                <!-- Validasi Error -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 rounded-xl text-sm">
                        <p class="font-semibold mb-1">Terjadi kesalahan pada isian kamu:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('catatan-poin.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Input Nama Siswa -->
                    <div>
                        <label for="siswa_id" class="block text-sm font-medium text-slate-300 mb-2">Pilih Siswa</label>
                        <select id="siswa_id" name="siswa_id"
                                class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-rose-500 text-white rounded-xl p-3.5 text-sm transition">
                            <option value="">-- Cari & Pilih Siswa --</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Jenis Pelanggaran -->
                    <div>
                        <label for="pelanggaran_id" class="block text-sm font-medium text-slate-300 mb-2">Jenis Pelanggaran</label>
                        <select id="pelanggaran_id" name="pelanggaran_id"
                                class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-rose-500 text-white rounded-xl p-3.5 text-sm transition">
                            <option value="">-- Pilih Jenis Pelanggaran --</option>
                            @foreach ($jenisPelanggarans as $jenisPelanggaran)
                                <option value="{{ $jenisPelanggaran->id }}" {{ old('pelanggaran_id') == $jenisPelanggaran->id ? 'selected' : '' }}>
                                    {{ $jenisPelanggaran->nama_pelanggaran }} (+{{ $jenisPelanggaran->poin }} Poin)
                                </option>
                            @endforeach
                        </select>
                        @error('pelanggaran_id')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-slate-300 mb-2">Tanggal Kejadian</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                               class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-rose-500 text-white rounded-xl p-3.5 text-sm transition">
                        @error('tanggal')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-slate-300 mb-2">Keterangan Tambahan <span class="text-slate-500 font-normal">(opsional)</span></label>
                        <textarea id="keterangan" name="keterangan" rows="3" placeholder="Tuliskan detail spesifik pelanggaran jika diperlukan..."
                                  class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-rose-500 text-white rounded-xl p-3.5 text-sm placeholder-slate-400 transition">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-1.5 text-sm text-rose-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-700 mt-4">
                        <a href="{{ route('catatan-poin.index') }}" class="text-sm text-slate-400 hover:text-slate-200 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-rose-600 hover:bg-rose-500 text-white font-bold py-2.5 px-8 rounded-xl transition shadow-lg shadow-rose-500/30 tracking-wide text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            SIMPAN POIN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>