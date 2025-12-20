<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/**
 * Categories routes
 */
Route::apiResource('categories', CategoryController::class);


/**
 * Posts routes
 */
Route::apiResource('posts', PostController::class);
