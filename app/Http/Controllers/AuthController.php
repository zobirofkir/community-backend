<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Services\Facades\AuthFacade;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register a new user in the system
     *
     * - Validate user input through RegisterRequest
     * - Create user record with hashed password (from model mutator)
     * - Assign role selected by user
     * - Return user details formatted in RegisterResource
     */
    public function register(RegisterRequest $request) : RegisterResource
    {
        return AuthFacade::register($request);
    }
}
