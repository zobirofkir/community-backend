<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
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

/**
 * Likes routes
 */
Route::post('posts/{post}/likes', [LikeController::class, 'like']);
