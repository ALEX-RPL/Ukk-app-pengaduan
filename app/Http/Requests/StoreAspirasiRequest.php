<?php

namespace App\Http\Requests;

use App\Models\Aspirasi;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAspirasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kategori' => ['required', 'in:'.implode(',', Aspirasi::KATEGORI_LIST)],
            'judul' => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string', 'min:10'],
            'lokasi' => ['required', 'string', 'max:255'],
            'gambar.*' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
        ];
    }

    public function messages(): array
    {
        return [
            'kategori.required' => 'Kategori harus dipilih.',
            'kategori.in' => 'Kategori tidak valid.',
            'judul.required' => 'Judul harus diisi.',
            'judul.max' => 'Judul maksimal 255 karakter.',
            'konten.required' => 'Konten harus diisi.',
            'konten.min' => 'Konten minimal 10 karakter.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'lokasi.max' => 'Lokasi maksimal 255 karakter.',
            'gambar.*.required' => 'Gambar harus diunggah.',
            'gambar.*.image' => 'File harus berupa gambar.',
            'gambar.*.max' => 'Ukuran gambar maksimal 2MB.',
            'gambar.*.mimes' => 'Format gambar harus: jpeg, png, jpg, gif.',
        ];
    }
}
