<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:5,1')->group(function () {
    /**
     * Create New User
     */
    Route::post('register', [AuthController::class, 'register']);

    /**
     * Login The User
     */
    Route::post('login', [AuthController::class, 'login']);

});
