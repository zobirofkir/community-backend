<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This file defines all API endpoints for your application.
| Routes are grouped by functionality and secured using middleware.
| Keep this file clean by separating route definitions into modules.
|
| Prefix Structure:
|   /auth           → Public auth endpoints (Register, Login)
|   /auth/users     → Secure endpoints for authenticated users
|
*/

Route::prefix('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Public Authentication Endpoints
    |--------------------------------------------------------------------------
    |
    | Contains routes accessible by guests.
    | Used for registering new accounts and authentication.
    |
    | Example Endpoints:
    |   POST /auth/register
    |   POST /auth/login
    |
    */
    require_once __DIR__.'/auth.php';

    /*
    |--------------------------------------------------------------------------
    | Protected Routes (Authenticated Users Only)
    |--------------------------------------------------------------------------
    |
    | These routes require a valid authentication token.
    | Endpoint Prefix: /auth/users
    |
    | Example Endpoints:
    |   GET /auth/users/me
    |   POST /auth/users/logout
    |
    */
    Route::middleware('auth:api')->prefix('users')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Current Authenticated User Routes
        |--------------------------------------------------------------------------
        |
        | Contains all endpoints related to the authenticated user's actions,
        | such as profile management, account info, password update, etc.
        |
        | Note:
        | Validation, authorization checks, and role permissions should
        | be handled inside controllers or FormRequest classes.
        |
        */
        require_once __DIR__.'/auth-users.php';

        /**
         * Protected Routes
         */
        require_once __DIR__.'/protected.php';

    });
});
