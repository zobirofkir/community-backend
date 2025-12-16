<?php

namespace App\Services\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateCurrentAuthUserRequest;
use App\Http\Resources\CurrentAuthUserResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

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

    /**
     * Authenticate an existing user
     *
     * - Check credentials submitted from LoginRequest
     * - Verify password against stored hash
     * - On failure → return 401 Unauthorized
     * - On success → return user details formatted in LoginResource
     */
    public function login(LoginRequest $request): LoginResource
    {
        $validated = $request->validated();

        $loginValue = $validated['login'];

        $user = User::where(function ($query) use ($loginValue) {
            $query->where('email', $loginValue)
                ->orWhere('username', $loginValue);
        })->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            abort(401, 'Invalid credentials.');
        }

        return LoginResource::make($user);
    }

    /**
     * Get the currently authenticated user
     *
     * - Fetch authenticated user via Auth::user()
     * - Return transformed response using CurrentAuthUserResource
     */
    public function me(): CurrentAuthUserResource
    {
        return CurrentAuthUserResource::make(Auth::user());
    }

    /**
     * Delete Current Authenticated User
     *
     * - Revoke all active tokens for the user (if using Sanctum/Passport)
     * - Permanently delete the user account
     * - Returns true if deletion was successful
     */
    public function deleteCurrentUser(): bool
    {
        $user = Auth::user();

        return $user->delete();
    }

    /**
     * Logout the current authenticated user
     *
     * - Revoke active API token for user
     * - Force re-authentication for future requests
     */
    public function logout(): bool
    {
        return Auth::user()->token()->revoke();
    }
}
