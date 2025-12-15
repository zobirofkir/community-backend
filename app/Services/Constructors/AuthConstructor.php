<?php

namespace App\Services\Constructors;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateCurrentAuthUserRequest;
use App\Http\Resources\CurrentAuthUserResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;

interface AuthConstructor
{
    /**
     * Register a new user in the system
     *
     * - Validate user input through RegisterRequest
     * - Create user record with hashed password (from model mutator)
     * - Assign role selected by user
     * - Return user details formatted in RegisterResource
     */
    public function register(RegisterRequest $request): RegisterResource;

    /**
     * Authenticate an existing user
     *
     * - Check credentials submitted from LoginRequest
     * - Verify password against stored hash
     * - On failure → return 401 Unauthorized
     * - On success → return user details formatted in LoginResource
     */
    public function login(LoginRequest $request): LoginResource;

    /**
     * Get the currently authenticated user
     *
     * - Fetch authenticated user via Auth::user()
     * - Return transformed response using CurrentAuthUserResource
     */
    public function me(): CurrentAuthUserResource;

    /**
     * Delete Current Authenticated User
     *
     * - Revoke all active tokens for the user (if using Sanctum/Passport)
     * - Permanently delete the user account
     * - Returns true if deletion was successful
     */
    public function deleteCurrentUser(): bool;

    /**
     * Logout the current authenticated user
     *
     * - Revoke active API token for user
     * - Force re-authentication for future requests
     */
    public function logout(): bool;
}
