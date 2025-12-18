<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCurrentAuthUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "sometimes|string|max:255",
            "email" => "sometimes|string|email|max:255|unique:users,email," . Auth::id(),
            "username" => "sometimes|string|max:255|unique:users,username," . Auth::id(),
            "password" => "nullable|string|min:8|confirmed",
            "avatar" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "cover" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "bio" => "nullable|string|max:500",
        ];
    }

    /**
     * Custom messages for validator errors (English).
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not exceed :max characters.',

            'email.required' => 'Email is required.',
            'email.string' => 'Email must be a string.',
            'email.email' => 'Please provide a valid email address.',
            'email.max' => 'Email must not exceed :max characters.',
            'email.unique' => 'This email is already in use.',

            'username.required' => 'Username is required.',
            'username.string' => 'Username must be a string.',
            'username.max' => 'Username must not exceed :max characters.',
            'username.unique' => 'This username is already taken.',

            'password.string' => 'Password must be a string.',
            'password.min' => 'Password must be at least :min characters.',
            'password.confirmed' => 'Password confirmation does not match.',

            'avatar.image' => 'Avatar must be an image.',
            'avatar.mimes' => 'Avatar must be a file of type: :values.',
            'avatar.max' => 'Avatar size must not exceed :max kilobytes.',
            
            'cover.image' => 'Cover photo must be an image.',
            'cover.mimes' => 'Cover photo must be a file of type: :values.',
            'cover.max' => 'Cover photo size must not exceed :max kilobytes.',

            'bio.string' => 'Bio must be a string.',
            'bio.max' => 'Bio must not exceed :max characters.',
        ];
    }

    /**
     * Human-friendly attribute names.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'name',
            'email' => 'email address',
            'username' => 'username',
            'password' => 'password',
            'password_confirmation' => 'password confirmation',
            'avatar' => 'avatar',
            'cover' => 'cover photo',
            'bio' => 'bio',
        ];
    }
}
