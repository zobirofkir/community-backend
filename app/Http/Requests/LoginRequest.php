<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => 'required|string',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'Email or username is required.',
            'login.string'   => 'Email or username must be a valid string.',

            'password.required' => 'The password field is required.',
            'password.string'   => 'The password must be a valid string.',
            'password.min'      => 'The password must be at least 8 characters.',
        ];
    }
}
