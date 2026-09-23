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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-t-2xl shadow-lg p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 relative overflow-hidden">
                <div class="relative z-10">
                    <a href="{{ route('dashboard') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-emerald-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Dashboard
                    </a>
                    <h3 class="text-2xl font-bold text-white tracking-wide">Histori Prestasi Siswa</h3>
                    <p class="text-emerald-100 text-sm mt-1">Riwayat pencatatan poin prestasi siswa.</p>
                </div>
                <div class="relative z-10">
                    <a href="{{ route('catatan-prestasi.create') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 backdrop-blur-sm font-bold py-2.5 px-6 rounded-xl transition duration-300 shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Input Prestasi
                    </a>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <div class="bg-slate-800 rounded-b-2xl shadow-xl p-6 sm:p-8 border-x border-b border-slate-700">

                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="overflow-x-auto rounded-xl border border-slate-700">
                    <table class="w-full text-sm text-left text-slate-300">
                        <thead class="text-xs uppercase bg-slate-900/50 text-slate-400 border-b border-slate-700">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Siswa</th>
                                <th class="px-6 py-4 font-semibold">Prestasi</th>
                                <th class="px-6 py-4 font-semibold text-center">Poin</th>
                                <th class="px-6 py-4 font-semibold">Tanggal</th>
                                <th class="px-6 py-4 font-semibold">Dicatat Oleh</th>
                                <th class="px-6 py-4 font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse ($catatanPrestasis as $catatanPrestasi)
                                <tr class="hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-bold text-white">
                                        {{ $catatanPrestasi->siswa->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $catatanPrestasi->prestasi->nama_prestasi ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold text-emerald-400">
                                            -{{ $catatanPrestasi->prestasi->poin ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $catatanPrestasi->tanggal->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $catatanPrestasi->guru->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-400">
                                        {{ $catatanPrestasi->keterangan ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 mb-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <p class="font-medium text-slate-400">Belum ada catatan prestasi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>