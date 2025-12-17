<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Get Current auth user
 */
Route::get('me', [AuthController::class, 'me']);

/**
 * Delete Current Auth User
 */
Route::delete('me', [AuthController::class, 'deleteCurrentUser']);

/**
 * Update Current Auth User
 */
Route::post('me', [AuthController::class, 'updateCurrentUser']);

/**
 * Logout Current Auth User
 */
Route::post('logout', [AuthController::class, 'logout']);
