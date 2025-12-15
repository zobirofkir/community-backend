<?php

namespace App\Services\Constructors;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;

interface AuthConstructor
{
    /**
     * Register New User
     */
    public function register(RegisterRequest $request) : RegisterResource;
}