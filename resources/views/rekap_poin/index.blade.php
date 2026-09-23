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

            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-t-2xl shadow-lg p-6 sm:p-8 relative overflow-hidden">
                <div class="relative z-10">
                    <a href="{{ route('dashboard') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Dashboard
                    </a>
                    <h3 class="text-2xl font-bold text-white tracking-wide">Rekap Poin Siswa</h3>
                    <p class="text-indigo-100 text-sm mt-1">Total poin bersih siswa (pelanggaran dikurangi prestasi, minimal 0).</p>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <div class="bg-slate-800 rounded-b-2xl shadow-xl p-6 sm:p-8 border-x border-b border-slate-700">

                <div class="overflow-x-auto rounded-xl border border-slate-700">
                    <table class="w-full text-sm text-left text-slate-300">
                        <thead class="text-xs uppercase bg-slate-900/50 text-slate-400 border-b border-slate-700">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Nama Siswa</th>
                                <th class="px-6 py-4 font-semibold text-center">Total Pelanggaran</th>
                                <th class="px-6 py-4 font-semibold text-center">Total Prestasi</th>
                                <th class="px-6 py-4 font-semibold text-center">Poin Bersih</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse ($rekap as $item)
                                <tr class="hover:bg-slate-700/30 transition-colors">
                                    <td class="px-6 py-4 font-bold text-white">
                                        {{ $item->siswa->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-rose-400 font-semibold">
                                        +{{ $item->total_pelanggaran }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-emerald-400 font-semibold">
                                        -{{ $item->total_prestasi }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 text-sm font-bold rounded-full
                                            @if ($item->total_bersih == 0) bg-emerald-500/10 text-emerald-400
                                            @elseif ($item->total_bersih < 50) bg-amber-500/10 text-amber-400
                                            @else bg-rose-500/10 text-rose-400
                                            @endif">
                                            {{ $item->total_bersih }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada data siswa.
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