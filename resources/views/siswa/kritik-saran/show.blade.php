@extends('layouts.app')

@section('title', 'Detail Kritik/Saran')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('siswa.kritik-saran.index') }}" class="text-blue-600 hover:text-blue-900">
            ← Kembali ke Daftar Kritik/Saran
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $kritikSaran->judul }}</h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span>
                            <strong class="text-gray-700">Pelapor:</strong> {{ $kritikSaran->user->name }}
                        </span>
                        <span>
                            <strong class="text-gray-700">NIS:</strong> {{ $kritikSaran->user->nis ?? '-' }}
                        </span>
                        <span>
                            <strong class="text-gray-700">Kelas:</strong> {{ $kritikSaran->user->kelas_info ?? '-' }}
                        </span>
                    </div>
                </div>
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $kritikSaran->getTipeBadgeClass() }}">
                    {{ $kritikSaran->getTipeLabel() }}
                </span>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Lokasi</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $kritikSaran->lokasi }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Tanggal</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $kritikSaran->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Pesan</h3>
                    <div class="text-gray-900 whitespace-pre-line">{{ $kritikSaran->pesan }}</div>
                </div>

                @if($kritikSaran->hasImages())
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Gambar</h3>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($kritikSaran->getImageUrls() as $url)
                        <div>
                            <a href="{{ $url }}" target="_blank">
                                <img src="{{ $url }}" alt="Gambar" class="w-full h-48 object-cover rounded-lg border-2 border-gray-200 hover:border-blue-500 transition">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
