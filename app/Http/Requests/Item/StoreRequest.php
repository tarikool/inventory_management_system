<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60',
            'image' => ['required','image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer|gt:0',
        ];
    }
}
