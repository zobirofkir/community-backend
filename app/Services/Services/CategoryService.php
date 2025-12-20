<?php

namespace App\Services\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Constructors\CategoryConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService implements CategoryConstructor
{
    /**
     * List all categories
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection(
            Category::paginate(10)
        );
    }

    /**
     * Show specific category
     */
    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }
}