<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Input Poin Siswa
        </h2>
    </x-slot>

    <div class="-mt-px min-h-screen bg-gray-900">
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl p-6 mb-6 text-white">
                    <h3 class="text-lg font-bold mb-1">Catat Poin Kedisiplinan</h3>
                    <p class="text-blue-50 text-sm">Pilih siswa dan jenis pelanggaran untuk mencatat poin baru.</p>
                </div>

                <div class="bg-gray-800 overflow-hidden shadow-sm rounded-2xl p-6">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-900/30 border border-red-700 text-red-300 rounded-lg text-sm">
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

                        <div>
                            <label for="siswa_id" class="block text-sm font-medium text-gray-300">Nama Siswa</label>
                            <select id="siswa_id" name="siswa_id"
                                    class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('siswa_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pelanggaran_id" class="block text-sm font-medium text-gray-300">Jenis Pelanggaran</label>
                            <select id="pelanggaran_id" name="pelanggaran_id"
                                    class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">-- Pilih Jenis Pelanggaran --</option>
                                @foreach ($jenisPelanggarans as $jenisPelanggaran)
                                    <option value="{{ $jenisPelanggaran->id }}" {{ old('pelanggaran_id') == $jenisPelanggaran->id ? 'selected' : '' }}>
                                        {{ $jenisPelanggaran->nama_pelanggaran }} ({{ $jenisPelanggaran->poin }} poin)
                                    </option>
                                @endforeach
                            </select>
                            @error('pelanggaran_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-300">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('tanggal')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-300">Keterangan (opsional)</label>
                            <textarea id="keterangan" name="keterangan" rows="3"
                                      class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <a href="{{ route('catatan-poin.index') }}" class="text-sm text-gray-400 hover:text-gray-200">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                Simpan Poin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>