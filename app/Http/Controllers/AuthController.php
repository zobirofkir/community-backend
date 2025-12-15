<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Services\Facades\AuthFacade;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register New User
     */
    public function register(RegisterRequest $request) : RegisterResource
    {
        return AuthFacade::register($request);
    }
}
