<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Jenis Pelanggaran
        </h2>
    </x-slot>

    <div class="-mt-px min-h-screen bg-gray-900">
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl p-6 mb-6 text-white">
                    <h3 class="text-lg font-bold mb-1">Tambah Data Pelanggaran</h3>
                    <p class="text-blue-50 text-sm">Isi form di bawah untuk menambahkan jenis pelanggaran baru ke sistem.</p>
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

                    <form action="{{ route('jenis-pelanggaran.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="nama_pelanggaran" class="block text-sm font-medium text-gray-300">Nama Pelanggaran</label>
                            <input type="text" id="nama_pelanggaran" name="nama_pelanggaran" value="{{ old('nama_pelanggaran') }}"
                                   placeholder="Contoh: Terlambat masuk kelas"
                                   class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('nama_pelanggaran')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="poin" class="block text-sm font-medium text-gray-300">Poin</label>
                            <input type="number" id="poin" name="poin" value="{{ old('poin') }}" min="0"
                                   class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            @error('poin')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-300">Kategori</label>
                            <select id="kategori" name="kategori"
                                    class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach (['ringan' => 'Ringan', 'sedang' => 'Sedang', 'berat' => 'Berat'] as $value => $labelText)
                                    <option value="{{ $value }}" {{ old('kategori') == $value ? 'selected' : '' }}>
                                        {{ $labelText }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <a href="{{ route('jenis-pelanggaran.index') }}" class="text-sm text-gray-400 hover:text-gray-200">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>