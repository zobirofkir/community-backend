<?php

namespace App\Services\Constructors;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface CategoryConstructor
{
    /**
     * List all categories
     */
    public function index(): AnonymousResourceCollection;

    /**
     * show specific category
     */
    public function show(Category $category): CategoryResource;
}