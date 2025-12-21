<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\Constructors\PostConstructor;
use App\Services\Facades\PostFacade;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller implements PostConstructor
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : AnonymousResourceCollection
    {
        return PostFacade::index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request) : PostResource
    {
        return PostFacade::store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) : PostResource
    {
        return PostFacade::show($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post) : PostResource
    {
        return PostFacade::update($request, $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) : bool
    {
        return PostFacade::destroy($post);
    }
}
