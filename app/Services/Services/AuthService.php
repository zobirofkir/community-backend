<?php

namespace App\Services\Services;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;

class AuthService implements AuthConstructor
{
    /**
     * Register a new user in the system
     *
     * - Validate user input through RegisterRequest
     * - Create user record with hashed password (from model mutator)
     * - Assign role selected by user
     * - Return user details formatted in RegisterResource
     */
    public function register(RegisterRequest $request): RegisterResource
    {
        $createUser = User::create($request->validated());

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $createUser->avatar = $path;
            $createUser->save();
        }

        return RegisterResource::make($createUser);
    }
}