@extends('layouts.app')

@section('title', 'Admin - Edit Kategori Laporan')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.kategori.index') }}" class="text-blue-600 hover:text-blue-900">
            ← Kembali ke Daftar Kategori
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Kategori Laporan</h2>

        <form method="POST" action="{{ route('admin.kategori.update', $kategori) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_kategori" id="nama_kategori"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       placeholder="Contoh: Fasilitas, Kebersihan, Keamanan"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                              @error('nama_kategori') border-red-500 @enderror"
                       required>
                @error('nama_kategori')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Slug akan dibuat otomatis dari nama kategori</p>
            </div>

            <div class="mb-4">
                <label for="warna" class="block text-sm font-medium text-gray-700 mb-2">
                    Warna Badge <span class="text-red-500">*</span>
                </label>
                <select name="warna" id="warna"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                               @error('warna') border-red-500 @enderror"
                        required>
                    <option value="blue" {{ old('warna', $kategori->warna) == 'blue' ? 'selected' : '' }}>Biru</option>
                    <option value="green" {{ old('warna', $kategori->warna) == 'green' ? 'selected' : '' }}>Hijau</option>
                    <option value="red" {{ old('warna', $kategori->warna) == 'red' ? 'selected' : '' }}>Merah</option>
                    <option value="yellow" {{ old('warna', $kategori->warna) == 'yellow' ? 'selected' : '' }}>Kuning</option>
                    <option value="purple" {{ old('warna', $kategori->warna) == 'purple' ? 'selected' : '' }}>Ungu</option>
                    <option value="pink" {{ old('warna', $kategori->warna) == 'pink' ? 'selected' : '' }}>Pink</option>
                    <option value="indigo" {{ old('warna', $kategori->warna) == 'indigo' ? 'selected' : '' }}>Indigo</option>
                    <option value="orange" {{ old('warna', $kategori->warna) == 'orange' ? 'selected' : '' }}>Oranye</option>
                    <option value="teal" {{ old('warna', $kategori->warna) == 'teal' ? 'selected' : '' }}>Teal</option>
                    <option value="cyan" {{ old('warna', $kategori->warna) == 'cyan' ? 'selected' : '' }}>Cyan</option>
                </select>
                @error('warna')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan Tampilan
                </label>
                <input type="number" name="urutan" id="urutan"
                       value="{{ old('urutan', $kategori->urutan) }}"
                       min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Semakin kecil angkanya, semakin atas posisinya</p>
            </div>

            <div class="mb-4">
                <label for="ikon" class="block text-sm font-medium text-gray-700 mb-2">
                    Ikon (Emoji)
                </label>
                <input type="text" name="ikon" id="ikon"
                       value="{{ old('ikon', $kategori->ikon ?? '') }}"
                       placeholder="Contoh: 🏫 🧹 🔒"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="mt-1 text-xs text-gray-500">Opsional - gunakan emoji atau ikon lain</p>
            </div>

            <div class="mb-6">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          placeholder="Deskripsi singkat tentang kategori ini..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                                 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
                @error('deskripsi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $kategori->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                </label>
                <p class="mt-1 text-xs text-gray-500">Kategori yang tidak aktif tidak akan ditampilkan di form laporan</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.kategori.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
