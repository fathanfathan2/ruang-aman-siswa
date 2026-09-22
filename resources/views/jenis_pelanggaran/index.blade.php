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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Banner Header Fitur (Gradient Merah-Oranye untuk Master Pelanggaran) -->
            <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-t-2xl shadow-lg p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-red-400/30 relative overflow-hidden">
                <div class="relative z-10">
                    <!-- Tombol Kembali -->
                    <a href="/dashboard" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-red-50 hover:text-white transition-all bg-black/10 hover:bg-black/30 px-3 py-1.5 rounded-lg border border-white/10 backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Dashboard
                    </a>
                    <h3 class="text-2xl font-bold text-white tracking-wide">Master Jenis Pelanggaran</h3>
                    <p class="text-red-100 text-sm mt-1">Kelola daftar pelanggaran, bobot poin, dan kategorinya.</p>
                </div>
                
                <div class="relative z-10">
                    <!-- Tombol Tambah Data -->
                    <a href="{{ route('jenis-pelanggaran.create') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 backdrop-blur-sm font-bold py-2.5 px-6 rounded-xl transition duration-300 shadow-lg flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pelanggaran
                    </a>
                </div>
                <!-- Efek cahaya background -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            </div>

            <!-- Area Konten Utama (Kartu Slate 800) -->
            <div class="bg-slate-800 rounded-b-2xl shadow-xl p-6 sm:p-8 border-x border-b border-slate-700">

                <!-- Alert Pesan Sukses -->
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-emerald-400 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Tabel Master Pelanggaran -->
                <div class="overflow-x-auto rounded-xl border border-slate-700">
                    <table class="w-full text-sm text-left text-slate-300">
                        <thead class="text-xs uppercase bg-slate-900/50 text-slate-400 border-b border-slate-700">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold w-1/2">Nama Pelanggaran</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">Poin</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">Kategori</th>
                                <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @forelse ($jenisPelanggarans as $jenisPelanggaran)
                                <tr class="hover:bg-slate-700/30 transition-colors">
                                    <!-- Nama Pelanggaran -->
                                    <td class="px-6 py-4 font-bold text-white">
                                        {{ $jenisPelanggaran->nama_pelanggaran }}
                                    </td>
                                    
                                    <!-- Bobot Poin -->
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold text-rose-400 text-base">
                                            +{{ $jenisPelanggaran->poin }}
                                        </span>
                                    </td>
                                    
                                    <!-- Label Kategori -->
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full border
                                            @if ($jenisPelanggaran->kategori === 'ringan') bg-amber-500/10 text-amber-400 border-amber-500/20
                                            @elseif ($jenisPelanggaran->kategori === 'sedang') bg-orange-500/10 text-orange-400 border-orange-500/20
                                            @else bg-rose-500/10 text-rose-400 border-rose-500/20
                                            @endif">
                                            {{ ucfirst($jenisPelanggaran->kategori) }}
                                        </span>
                                    </td>
                                    
                                    <!-- Tombol Aksi -->
                                    <td class="px-6 py-4 flex justify-center gap-3">
                                        <a href="{{ route('jenis-pelanggaran.edit', $jenisPelanggaran) }}"
                                           class="text-blue-400 hover:text-blue-300 transition-colors font-medium text-sm">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('jenis-pelanggaran.destroy', $jenisPelanggaran) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus jenis pelanggaran ini? Data poin siswa yang terkait mungkin akan terpengaruh.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-rose-400 hover:text-rose-300 transition-colors font-medium text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 mb-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            <p class="font-medium text-slate-400">Belum ada daftar jenis pelanggaran.</p>
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