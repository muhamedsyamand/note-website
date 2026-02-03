<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'number' => 'nullable|string|max:255',
            'numbers' => 'nullable|string',
            'note_date' => 'nullable|date',
            'phone_number' => 'nullable|string|max:20',
            'seller_name' => 'nullable|string|max:255',
            'other_things' => 'nullable|string',
        ];
    }
}
