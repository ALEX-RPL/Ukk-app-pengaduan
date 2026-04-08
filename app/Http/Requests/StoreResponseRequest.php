<?php

namespace App\Http\Requests;

use App\Models\Response;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'response_text' => ['required', 'string', 'min:10'],
            'status_update' => ['required', 'in:'.implode(',', Response::STATUS_LIST)],
        ];
    }

    public function messages(): array
    {
        return [
            'response_text.required' => 'Umpan balik harus diisi.',
            'response_text.min' => 'Umpan balik minimal 10 karakter.',
            'status_update.required' => 'Status harus dipilih.',
            'status_update.in' => 'Status tidak valid.',
        ];
    }
}
