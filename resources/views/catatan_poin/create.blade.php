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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-t-2xl shadow-lg p-6 sm:p-8 relative overflow-hidden">
                <div class="relative z-10">
                    <a href="{{ route('catatan-poin.index') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Histori
                    </a>
                    <h3 class="text-2xl font-bold text-white tracking-wide">Catat Poin Kedisiplinan</h3>
                    <p class="text-blue-100 text-sm mt-1">Cari siswa dan pilih jenis pelanggaran untuk mencatat poin.</p>
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

                <form action="{{ route('catatan-poin.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="relative">
                        <label for="siswa_search" class="block text-sm font-semibold text-slate-300 mb-1">Nama Siswa</label>
                        <input type="text" id="siswa_search" autocomplete="off" placeholder="Ketik untuk mencari nama siswa..."
                               value="{{ old('siswa_id') ? collect($siswas)->firstWhere('id', old('siswa_id'))?->name : '' }}"
                               class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white placeholder-slate-500 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <input type="hidden" id="siswa_id" name="siswa_id" value="{{ old('siswa_id') }}">

                        <div id="siswa_dropdown"
                             class="hidden absolute z-10 mt-1 w-full bg-slate-900 border border-slate-600 rounded-xl shadow-lg max-h-48 overflow-y-auto">
                            @foreach ($siswas as $siswa)
                                <div class="siswa-option px-4 py-2 text-sm text-slate-100 hover:bg-blue-600 cursor-pointer"
                                     data-id="{{ $siswa->id }}" data-name="{{ $siswa->name }}">
                                    {{ $siswa->name }}
                                </div>
                            @endforeach
                        </div>

                        @error('siswa_id')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pelanggaran_id" class="block text-sm font-semibold text-slate-300 mb-1">Jenis Pelanggaran</label>
                        <select id="pelanggaran_id" name="pelanggaran_id"
                                class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="">-- Pilih Jenis Pelanggaran --</option>
                            @foreach ($jenisPelanggarans as $jenisPelanggaran)
                                <option value="{{ $jenisPelanggaran->id }}" {{ old('pelanggaran_id') == $jenisPelanggaran->id ? 'selected' : '' }}>
                                    {{ $jenisPelanggaran->nama_pelanggaran }} (+{{ $jenisPelanggaran->poin }} poin)
                                </option>
                            @endforeach
                        </select>
                        @error('pelanggaran_id')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-slate-300 mb-1">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                               class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        @error('tanggal')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-semibold text-slate-300 mb-1">Keterangan (opsional)</label>
                        <textarea id="keterangan" name="keterangan" rows="3"
                                  class="block w-full rounded-xl border-slate-600 bg-slate-900/60 text-white shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-sm text-rose-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('catatan-poin.index') }}" class="text-sm text-slate-400 hover:text-slate-200">
                            Batal
                        </a>
                        <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-cyan-500 hover:opacity-90 text-white font-bold py-2.5 px-6 rounded-xl transition duration-300 shadow-lg text-sm">
                            Simpan Poin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('siswa_search');
            const hiddenInput = document.getElementById('siswa_id');
            const dropdown = document.getElementById('siswa_dropdown');
            const options = dropdown.querySelectorAll('.siswa-option');

            searchInput.addEventListener('focus', function () {
                dropdown.classList.remove('hidden');
            });

            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase();
                hiddenInput.value = '';

                options.forEach(function (opt) {
                    const name = opt.dataset.name.toLowerCase();
                    opt.style.display = name.includes(keyword) ? 'block' : 'none';
                });

                dropdown.classList.remove('hidden');
            });

            options.forEach(function (opt) {
                opt.addEventListener('click', function () {
                    searchInput.value = this.dataset.name;
                    hiddenInput.value = this.dataset.id;
                    dropdown.classList.add('hidden');
                });
            });

            document.addEventListener('click', function (e) {
                if (!e.target.closest('#siswa_search') && !e.target.closest('#siswa_dropdown')) {
                    dropdown.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>