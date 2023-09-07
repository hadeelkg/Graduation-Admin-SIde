<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderProductRequest extends FormRequest
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
            'product_price' => ['required','string','max:3'],
            'quantity' => ['required','string','max:2'],
            'subtotal_price' => ['required','string', 'max:10'],
            'product_id' => ['required','integer'],
            'order_id' => ['required','integer'],
        ];
    }
}
