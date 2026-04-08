@extends('layouts.app')

@section('title', 'Buat Aspirasi Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Buat Aspirasi Baru</h2>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form method="POST" action="{{ route('siswa.aspirasi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori
                </label>
                <select name="kategori" id="kategori"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                               @error('kategori') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->slug }}" {{ old('kategori') == $kategori->slug ? 'selected' : '' }}>
                            @if($kategori->ikon) {{ $kategori->ikon }} @endif
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                    Judul Aspirasi
                </label>
                <input type="text"
                       name="judul"
                       id="judul"
                       placeholder="Contoh: AC Ruang Kelas Rusak"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                              @error('judul') border-red-500 @enderror"
                       value="{{ old('judul') }}">
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                    Lokasi Sarana
                </label>
                <input type="text"
                       name="lokasi"
                       id="lokasi"
                       placeholder="Contoh: Gedung A, Lantai 2, Ruang Kelas XII IPA 1"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                              @error('lokasi') border-red-500 @enderror"
                       value="{{ old('lokasi') }}">
                <p class="mt-1 text-xs text-gray-500">Sebutkan lokasi spesifik sarana yang diadukan</p>
                @error('lokasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                    Detail Aspirasi
                </label>
                <textarea name="konten"
                          id="konten"
                          rows="5"
                          placeholder="Jelaskan detail aspirasi atau pengaduan Anda..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                                 @error('konten') border-red-500 @enderror">{{ old('konten') }}</textarea>
                @error('konten')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                    Upload Gambar <span class="text-red-500">*</span>
                </label>
                <input type="file"
                       name="gambar[]"
                       id="gambar"
                       multiple
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                              @error('gambar.*') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB per gambar. Minimal 1 gambar wajib diunggah.</p>
                @error('gambar.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Image Preview -->
                <div id="imagePreview" class="mt-3 grid grid-cols-3 gap-3 hidden">
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('siswa.aspirasi.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Kirim Aspirasi
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// Image preview functionality
document.getElementById('gambar').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (this.files && this.files.length > 0) {
        if (this.files.length > 3) {
            alert('Maksimal 3 gambar yang diupload');
            this.value = '';
            preview.classList.add('hidden');
            return;
        }

        preview.classList.remove('hidden');

        Array.from(this.files).forEach((file, index) => {
            if (index < 3) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-gray-200">
                        <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        preview.classList.add('hidden');
    }
});
</script>
@endpush
@endsection
