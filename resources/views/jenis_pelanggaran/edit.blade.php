<x-app-layout>
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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-t-2xl shadow-lg p-6 sm:p-8 relative overflow-hidden">
                <div class="relative z-10">
                    <a href="{{ route('jenis-pelanggaran.index') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-red-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar
                    </a>
                    <h3 class="text-2xl font-bold text-white tracking-wide">Edit Jenis Pelanggaran</h3>
                    <p class="text-red-100 text-sm mt-1">Perbarui data pelanggaran di bawah ini.</p>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <div class="bg-slate-800 rounded-b-2xl shadow-xl p-6 sm:p-8 border-x border-b border-slate-700">

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-sm">
                        <p class="font-semibold text-rose-400 mb-1">Terjadi kesalahan pada isian kamu:</p>
                        <ul class="list-disc list-inside space-y-1 text-rose-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jenis-pelanggaran.update', $jenisPelanggaran) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="nama_pelanggaran" class="block text-sm font-semibold text-slate-300 mb-1">Nama Pelanggaran</label>
                        <input type="text" id="nama_pelanggaran" name="nama_pelanggaran"
                               value="{{ old('nama_pelanggaran', $jenisPelanggaran->nama_pelanggaran) }}"
                               class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                        @error('nama_pelanggaran')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="poin" class="block text-sm font-semibold text-slate-300 mb-1">Poin</label>
                        <input type="number" id="poin" name="poin"
                               value="{{ old('poin', $jenisPelanggaran->poin) }}" min="0"
                               class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                        @error('poin')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-slate-300 mb-1">Kategori</label>
                        <select id="kategori" name="kategori"
                                class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 text-sm">
                            @foreach (['ringan' => 'Ringan', 'sedang' => 'Sedang', 'berat' => 'Berat'] as $value => $labelText)
                                <option value="{{ $value }}"
                                    {{ old('kategori', $jenisPelanggaran->kategori) == $value ? 'selected' : '' }}>
                                    {{ $labelText }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('jenis-pelanggaran.index') }}" class="text-sm text-slate-400 hover:text-slate-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-gradient-to-r from-orange-500 to-red-600 hover:opacity-90 text-white font-bold py-2.5 px-6 rounded-xl transition duration-300 shadow-lg text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>