<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacistRequest extends FormRequest
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
            // 'image_path' => ['image', 'mimes:jpeg,png,jpg', 'max:4000'],
            'role' => ['required','string','max:50'],
            'bio' => ['required','string','max:200'],
            'facebook_link' => ['required','string'],
            'phone' => ['required','string','max:10','min:10'],
        ];
    }
}
