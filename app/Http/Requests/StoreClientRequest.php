<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => ['required','string','max:70', 'min:2', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required','email', 'unique:clients,email', 'max:254'],
            'password' => ['required','string','max:8','min:8'],
            'gender' => ['required','string'],
            'phone' => ['required','numeric', 'regex:/^(09)?[1,2,3,4]\d{7}$/', 'unique:clients,phone'],
            'address' => ['required','string','max:200'],
            'city_id' => ['required','integer'],
        ];
    }
}
