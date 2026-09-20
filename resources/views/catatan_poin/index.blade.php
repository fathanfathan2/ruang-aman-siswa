<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Histori Kedisiplinan
        </h2>
    </x-slot>

    <div class="-mt-px min-h-screen bg-gray-900">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-100">Riwayat Poin Siswa</h3>
                    <a href="{{ route('catatan-poin.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition">
                        + Input Poin
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Siswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Pelanggaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Poin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Dicatat Oleh</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @forelse ($catatanPoins as $catatanPoin)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-100">
                                            {{ $catatanPoin->siswa->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $catatanPoin->pelanggaran->nama_pelanggaran ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $catatanPoin->pelanggaran->poin ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $catatanPoin->tanggal->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                            {{ $catatanPoin->guru->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-400">
                                            {{ $catatanPoin->keterangan ?? '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                            Belum ada catatan poin.
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