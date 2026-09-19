<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Sesi Konseling
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm">
                        <p class="font-semibold mb-1">Terjadi kesalahan pada isian kamu:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sesi-konseling.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="topik" class="block text-sm font-medium text-gray-700">Topik Konseling</label>
                        <input type="text" id="topik" name="topik" value="{{ old('topik') }}"
                               placeholder="Contoh: Kesulitan mengatur waktu belajar"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('topik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jadwal" class="block text-sm font-medium text-gray-700">Jadwal Konseling</label>
                        <input type="datetime-local" id="jadwal" name="jadwal" value="{{ old('jadwal') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('jadwal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Konseling</label>
                        <div class="flex gap-4">
                            <label class="flex-1 flex items-center gap-2 border border-gray-300 rounded-md p-3 text-sm cursor-pointer">
                                <input type="radio" name="tipe" value="terbuka"
                                       {{ old('tipe', 'terbuka') == 'terbuka' ? 'checked' : '' }}>
                                Terbuka
                            </label>
                            <label class="flex-1 flex items-center gap-2 border border-gray-300 rounded-md p-3 text-sm cursor-pointer">
                                <input type="radio" name="tipe" value="anonim"
                                       {{ old('tipe') == 'anonim' ? 'checked' : '' }}>
                                Anonim
                            </label>
                        </div>
                        @error('tipe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <a href="{{ route('sesi-konseling.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                            Booking Konseling
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>