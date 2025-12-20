<?php

namespace App\Services\Constructors;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface PostConstructor
{
    /**
     * Display a listing of the resource.
     */
    public function index() : AnonymousResourceCollection;

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request) : PostResource;

    /**
     * Display the specified resource.
     */
    public function show(Post $post) : PostResource;

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post) : PostResource;

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) : PostResource;
}