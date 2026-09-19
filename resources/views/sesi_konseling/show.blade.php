<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Sesi Konseling
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <dl class="divide-y divide-gray-200">
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Topik</dt>
                        <dd class="text-gray-900">{{ $sesiKonseling->topik }}</dd>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Jadwal</dt>
                        <dd class="text-gray-900">{{ $sesiKonseling->jadwal->format('d M Y, H:i') }}</dd>
                    </div>
                    <div class="py-3 flex justify-between items-center text-sm">
                        <dt class="font-medium text-gray-500">Tipe</dt>
                        <dd>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $sesiKonseling->tipe === 'terbuka' ? 'bg-indigo-100 text-indigo-700' : 'bg-purple-100 text-purple-700' }}">
                                {{ ucfirst($sesiKonseling->tipe) }}
                            </span>
                        </dd>
                    </div>
                    <div class="py-3 flex justify-between items-center text-sm">
                        <dt class="font-medium text-gray-500">Status</dt>
                        <dd>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if ($sesiKonseling->status === 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif ($sesiKonseling->status === 'disetujui') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700
                                @endif">
                                {{ ucfirst($sesiKonseling->status) }}
                            </span>
                        </dd>
                    </div>
                    @if ($sesiKonseling->tipe !== 'anonim' && $sesiKonseling->siswa)
                        <div class="py-3 flex justify-between text-sm">
                            <dt class="font-medium text-gray-500">Siswa</dt>
                            <dd class="text-gray-900">{{ $sesiKonseling->siswa->name }}</dd>
                        </div>
                    @endif
                </dl>

                <div class="mt-6">
                    <a href="{{ route('sesi-konseling.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900">
                        &larr; Kembali ke daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>