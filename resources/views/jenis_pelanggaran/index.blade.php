<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Jenis Pelanggaran
            </h2>
        </div>
    </x-slot>

    <div class="-mt-px min-h-screen bg-gray-900">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-100">Daftar Jenis Pelanggaran</h3>
                    <a href="{{ route('jenis-pelanggaran.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                        + Tambah Jenis Pelanggaran
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-900/30 border border-green-700 text-green-300 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-gray-800 overflow-hidden shadow-sm rounded-2xl">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-900/40">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Nama Pelanggaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Poin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($jenisPelanggarans as $jenisPelanggaran)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-100">
                                            {{ $jenisPelanggaran->nama_pelanggaran }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $jenisPelanggaran->poin }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                @if ($jenisPelanggaran->kategori === 'ringan') bg-yellow-900/40 text-yellow-300
                                                @elseif ($jenisPelanggaran->kategori === 'sedang') bg-orange-900/40 text-orange-300
                                                @else bg-red-900/40 text-red-300
                                                @endif">
                                                {{ ucfirst($jenisPelanggaran->kategori) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-3">
                                            <a href="{{ route('jenis-pelanggaran.edit', $jenisPelanggaran) }}"
                                               class="text-blue-400 hover:text-blue-300">Edit</a>
                                            <form action="{{ route('jenis-pelanggaran.destroy', $jenisPelanggaran) }}" method="POST"
                                                  class="inline" onsubmit="return confirm('Yakin ingin menghapus jenis pelanggaran ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                            Belum ada jenis pelanggaran yang ditambahkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>