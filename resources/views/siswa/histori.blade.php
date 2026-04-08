@extends('layouts.app')

@section('title', 'Histori Aspirasi')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Histori Aspirasi</h2>
    <p class="text-gray-600 mt-1">Lihat progres perbaikan aspirasi Anda</p>
</div>

@if($aspirasis->count() > 0)
    <div class="space-y-4">
        @foreach($aspirasis as $aspirasi)
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $aspirasi->judul }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ $aspirasi->created_at->format('d M Y') }} | {{ $aspirasi->getCategoryLabel() }}
                        </p>
                    </div>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $aspirasi->getStatusBadgeClass() }}">
                        {{ $aspirasi->getStatusLabel() }}
                    </span>
                </div>

                @if($aspirasi->latestResponse)
                    <div class="mt-4 pt-4 border-t">
                        <p class="text-sm font-semibold text-gray-700 mb-1">Umpan Balik Terbaru:</p>
                        <p class="text-gray-600 text-sm">{{ Str::limit($aspirasi->latestResponse->response_text, 150) }}</p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $aspirasi->latestResponse->created_at->diffForHumans() }}
                        </p>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('siswa.aspirasi.show', $aspirasi) }}" 
                       class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                        Lihat Histori Lengkap →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-8 text-center">
        <p class="text-gray-600">Belum ada histori aspirasi.</p>
    </div>
@endif
@endsection
