<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Laporan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Banner Peringatan Aman -->
            <div class="mb-6 bg-cyan-500/10 border border-cyan-500/20 rounded-2xl p-4 flex items-start gap-4">
                <div class="text-cyan-400 mt-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-cyan-400 font-bold">Ruang Aman & Rahasia</h4>
                    <p class="text-slate-400 text-sm mt-1">Jangan takut untuk bersuara. Laporanmu akan dienkripsi dan hanya dapat dibaca oleh Guru BK yang berwenang. Kamu juga bisa memilih untuk melaporkan secara anonim.</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-slate-800 rounded-2xl shadow-xl p-6 sm:p-10 border border-slate-700">
                <!-- Action diubah mengarah ke route store -->
                <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Judul Laporan -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Judul Laporan</label>
                        <input type="text" name="judul" placeholder="Contoh: Terjadi perundungan di kelas 11..." class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                    </div>

                    <!-- Kategori & Waktu Kejadian -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kategori Masalah</label>
                            <select name="kategori" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" required>
                                <option value="">Pilih Kategori...</option>
                                <option value="bullying">Perundungan (Bullying)</option>
                                <option value="fasilitas">Kerusakan Fasilitas</option>
                                <option value="pelanggaran">Pelanggaran Tata Tertib</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-300 mb-2">Kapan Kejadiannya?</label>
                            <input type="date" name="tanggal_kejadian" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors">
                        </div>
                    </div>

                    <!-- Detail Kejadian -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Ceritakan Detail Kejadian</label>
                        <textarea name="deskripsi" rows="5" placeholder="Ceritakan apa yang terjadi secara detail. Siapa yang terlibat, di mana lokasinya..." class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors" required></textarea>
                    </div>

                    <!-- Fitur Anonim -->
                    <div class="flex items-center gap-3 bg-slate-900/50 p-4 rounded-xl border border-slate-700">
                        <input type="checkbox" id="anonim" name="is_anonim" value="1" class="w-5 h-5 rounded border-slate-500 text-cyan-500 focus:ring-cyan-500 bg-slate-800">
                        <label for="anonim" class="text-sm text-slate-300 cursor-pointer">
                            <span class="font-bold text-white">Kirim sebagai Anonim</span> (Nama kamu tidak akan ditampilkan ke Guru BK)
                        </label>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-4 pt-4 border-t border-slate-700">
                        <a href="{{ route('siswa.dashboard') }}" class="px-6 py-3 rounded-xl text-slate-300 font-semibold hover:bg-slate-700 transition-colors">Batal</a>
                        <!-- Type diubah menjadi submit -->
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold rounded-xl shadow-lg shadow-cyan-500/20 transition-all transform hover:-translate-y-0.5">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>