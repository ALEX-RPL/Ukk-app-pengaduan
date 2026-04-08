@extends('layouts.app')

@section('title', 'Admin - Detail Kategori Laporan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.kategori.index') }}" class="text-blue-600 hover:text-blue-900">
            ← Kembali ke Daftar Kategori
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    @if($kategori->ikon)
                        <span class="text-2xl">{{ $kategori->ikon }}</span>
                    @endif
                    <h2 class="text-2xl font-bold text-gray-900">{{ $kategori->nama_kategori }}</h2>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $kategori->getBadgeClass() }}">
                        {{ $kategori->nama_kategori }}
                    </span>
                </div>
                <div class="space-y-1 text-sm text-gray-600">
                    <p><span class="font-medium">Slug:</span> {{ $kategori->slug }}</p>
                    <p><span class="font-medium">Status:</span>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $kategori->getStatusBadgeClass() }}">
                            {{ $kategori->getStatusLabel() }}
                        </span>
                    </p>
                    <p><span class="font-medium">Urutan:</span> {{ $kategori->urutan }}</p>
                    @if($kategori->deskripsi)
                        <p><span class="font-medium">Deskripsi:</span> {{ $kategori->deskripsi }}</p>
                    @endif
                    <p><span class="font-medium">Dibuat:</span> {{ $kategori->created_at->format('d M Y H:i') }}</p>
                    <p><span class="font-medium">Terakhir Diupdate:</span> {{ $kategori->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <div class="space-x-2">
                <a href="{{ route('admin.kategori.edit', $kategori) }}"
                   class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-md inline-block">
                    Edit
                </a>
            </div>
        </div>
    </div>

    @if($kategori->aspirasis->count() > 0)
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Daftar Laporan ({{ $kategori->aspirasis->count() }})</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($kategori->aspirasis->sortByDesc('created_at') as $aspirasi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $aspirasi->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $aspirasi->user->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ Str::limit($aspirasi->judul, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $aspirasi->getStatusBadgeClass() }}">
                                        {{ $aspirasi->getStatusLabel() }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600">Belum ada laporan untuk kategori ini.</p>
        </div>
    @endif
</div>
@endsection
