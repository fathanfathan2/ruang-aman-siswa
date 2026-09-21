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

            <!-- Banner Header Form (Gradient Orange-Red) -->
            <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl shadow-lg p-6 sm:p-8 text-white relative overflow-hidden flex justify-between items-center">
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold tracking-wide">Edit Jenis Pelanggaran</h3>
                    <p class="text-red-100 text-sm mt-1">Perbarui nama, bobot poin, atau kategori pelanggaran ini.</p>
                </div>
                <!-- Icon Dekoratif -->
                <div class="relative z-10 hidden sm:block opacity-80">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Card Form Utama (Slate 800) -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-700">

                <!-- Validasi Error -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 text-red-400 rounded-xl text-sm">
                        <p class="font-semibold mb-1">Terjadi kesalahan pada isian kamu:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jenis-pelanggaran.update', $jenisPelanggaran) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Input Nama Pelanggaran -->
                    <div>
                        <label for="nama_pelanggaran" class="block text-sm font-medium text-slate-300 mb-2">Nama Pelanggaran</label>
                        <input type="text" id="nama_pelanggaran" name="nama_pelanggaran" 
                               value="{{ old('nama_pelanggaran', $jenisPelanggaran->nama_pelanggaran) }}"
                               placeholder="Contoh: Terlambat masuk kelas"
                               class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-red-500 text-white rounded-xl p-3.5 text-sm transition">
                        @error('nama_pelanggaran')
                            <p class="mt-1.5 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Poin -->
                    <div>
                        <label for="poin" class="block text-sm font-medium text-slate-300 mb-2">Bobot Poin</label>
                        <input type="number" id="poin" name="poin" 
                               value="{{ old('poin', $jenisPelanggaran->poin) }}" min="0"
                               class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-red-500 text-white rounded-xl p-3.5 text-sm transition">
                        @error('poin')
                            <p class="mt-1.5 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-slate-300 mb-2">Kategori Pelanggaran</label>
                        <select id="kategori" name="kategori"
                                class="w-full bg-slate-700 border-none focus:ring-2 focus:ring-red-500 text-white rounded-xl p-3.5 text-sm transition">
                            @foreach (['ringan' => 'Ringan', 'sedang' => 'Sedang', 'berat' => 'Berat'] as $value => $labelText)
                                <option value="{{ $value }}" {{ old('kategori', $jenisPelanggaran->kategori) == $value ? 'selected' : '' }}>
                                    {{ $labelText }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="mt-1.5 text-sm text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center justify-between pt-6 border-t border-slate-700 mt-4">
                        <a href="{{ route('jenis-pelanggaran.index') }}" class="text-sm text-slate-400 hover:text-slate-200 transition font-medium">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-500 text-white font-bold py-2.5 px-8 rounded-xl transition shadow-lg shadow-red-500/30 tracking-wide text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>