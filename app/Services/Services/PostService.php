<?php

namespace App\Services\Services;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\Constructors\PostConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PostService implements PostConstructor
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {        
        return PostResource::collection(
            Post::paginate(10)->load(['user', 'category'])
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request) : PostResource
    {
        $post = Auth::user()->posts()->create($request->validated());

        $post->load(['user', 'category']);
        
        return PostResource::make($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): PostResource
    {
        $post->increment('views');
        
        $post->load(['user', 'category']);
        
        return PostResource::make($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post) : PostResource
    {
        $post->update($request->validated());

        return PostResource::make(
            $post->refresh()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) : bool
    {
        return $post->delete();
    }
}