<?php

namespace App\Services\Services;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Services\Constructors\AuthConstructor;

class AuthService implements AuthConstructor
{
    /**
     * Register New User
     */
    public function register(RegisterRequest $request) : RegisterResource
    {
        //
    }
}