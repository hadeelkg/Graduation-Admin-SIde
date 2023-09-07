<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class UpdateAdminRequest extends FormRequest
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
            // 'email' => ['required','email', 'unique:clients,email', 'max:254'],
            'email' => ['required','email', 'max:254'],
            'password' => ['required']
        ];

    }
}
