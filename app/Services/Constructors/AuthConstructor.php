<?php

namespace App\Services\Constructors;

use App\Http\Requests\RegisterRequest;
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
    public function register(RegisterRequest $request) : RegisterResource;
}