<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|int',
            'buyer' => 'required|string',
            'receipt_id' => 'required|string|max:20',
            'items' => 'required|string',
            'buyer_email' => 'required|email',
            'note' => 'nullable|string',
            'city' => 'required|string',
            'phone' => 'required|numeric|regex:/^[0-9]{10}$/',
        ];
    }
}
