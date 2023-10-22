<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required','string','max:50'],
            'image_path' => ['image', 'mimes:jpeg,png,jpg', 'max:4000'],
            'price' => ['required','string','max:3'],
            'description' => ['required','string','max:200'],
            // 'target_sex' => ['string','max:200'],
            'quantity' => ['required','string','max:10'],
            'category_id' => ['required','integer'],
            'brand_id' => ['required','integer'],
        ];
    }
}
