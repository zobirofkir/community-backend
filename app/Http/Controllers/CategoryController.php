<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Services\Constructors\CategoryConstructor;
use App\Services\Facades\CategoryFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller implements CategoryConstructor
{
    /**
     * List all categories
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryFacade::index();
    }

    /**
     * show specific category
     */
    public function show(Category $category): CategoryResource
    {
        return CategoryFacade::show($category);
    }
}
