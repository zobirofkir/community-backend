<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/**
 * Categories routes
 */
Route::apiResource('categories', CategoryController::class);
