@extends('layouts.app')

@section('title', 'Detail Aspirasi - ' . $aspirasi->judul)

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.aspirasi.index') }}" class="text-blue-600 hover:text-blue-900">
            ← Kembali ke Daftar Aspirasi
        </a>
    </div>

    {{-- Detail Aspirasi --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $aspirasi->judul }}</h2>
                <div class="space-y-1 text-sm text-gray-600">
                    <p><span class="font-medium">Siswa:</span> {{ $aspirasi->user->name }}</p>
                    <p><span class="font-medium">NIS:</span> {{ $aspirasi->user->nis ?? '-' }}</p>
                    <p><span class="font-medium">Kelas:</span> {{ $aspirasi->user->kelasInfo ?? '-' }}</p>
                    <p><span class="font-medium">Kategori:</span> {{ $aspirasi->getCategoryLabel() }}</p>
                    <p><span class="font-medium">Tanggal:</span> {{ $aspirasi->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $aspirasi->getStatusBadgeClass() }}">
                {{ $aspirasi->getStatusLabel() }}
            </span>
        </div>

        @if($aspirasi->lokasi)
            <div class="border-t border-b py-3 my-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-gray-500 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Lokasi:</p>
                        <p class="text-gray-600">{{ $aspirasi->lokasi }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="border-t pt-4 mt-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Detail Aspirasi</h3>
            <p class="text-gray-700 whitespace-pre-line">{{ $aspirasi->konten }}</p>
        </div>

        @if($aspirasi->hasImages())
            <div class="border-t pt-4 mt-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    Gambar Sarana ({{ $aspirasi->getImagesCount() }})
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($aspirasi->getImageUrls() as $imageUrl)
                        <div class="relative group">
                            <a href="{{ $imageUrl }}" target="_blank">
                                <img src="{{ $imageUrl }}"
                                     alt="Gambar aspirasi"
                                     class="w-full h-48 object-cover rounded-lg border-2 border-gray-200 cursor-pointer hover:opacity-75 transition">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    {{-- Form Umpan Balik --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Berikan Umpan Balik</h3>

        <form method="POST" action="{{ route('admin.aspirasi.response.store', $aspirasi) }}">
            @csrf

            <div class="mb-4">
                <label for="status_update" class="block text-sm font-medium text-gray-700 mb-2">
                    Status Penyelesaian
                </label>
                <select name="status_update" id="status_update"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                               @error('status_update') border-red-500 @enderror">
                    <option value="">Pilih Status</option>
                    <option value="diproses">Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="ditolak">Ditolak</option>
                </select>
                @error('status_update')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="response_text" class="block text-sm font-medium text-gray-700 mb-2">
                    Umpan Balik
                </label>
                <textarea name="response_text"
                          id="response_text"
                          rows="4"
                          placeholder="Tulis umpan balik untuk aspirasi ini..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                                 @error('response_text') border-red-500 @enderror">{{ old('response_text') }}</textarea>
                @error('response_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md">
                Kirim Umpan Balik
            </button>
        </form>
    </div>

    {{-- Histori Umpan Balik --}}
    @if($aspirasi->responses->count() > 0)
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Histori Umpan Balik</h3>

            <div class="space-y-4">
                @foreach($aspirasi->responses->sortBy('created_at') as $response)
                    <div class="border-l-4 border-blue-500 pl-4 py-3 bg-gray-50 rounded">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $response->admin->name }}</p>
                                <p class="text-sm text-gray-600">{{ $response->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                {{ $response->status_update === 'selesai' ? 'bg-green-100 text-green-800' :
                                   ($response->status_update === 'diproses' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                {{ $response->getStatusUpdateLabel() }}
                            </span>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $response->response_text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg p-6 text-center">
            <p class="text-gray-600">Belum ada umpan balik untuk aspirasi ini.</p>
        </div>
    @endif
</div>
@endsection
