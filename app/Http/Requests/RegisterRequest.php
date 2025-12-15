<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ];
    }

    /**
     * Custom validation messages (English).
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 100 characters.',

            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a valid string.',
            'username.max' => 'The username may not be greater than 50 characters.',
            'username.unique' => 'This username is already taken.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'The email may not be greater than 150 characters.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',

            'avatar.image' => 'The avatar must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: jpg, jpeg, png, webp, gif.',
            'avatar.max' => 'The avatar may not be greater than 2MB.',
        ];
    }
}
