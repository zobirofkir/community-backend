<?php

namespace App\Services\Services;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\Constructors\PostConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostService implements PostConstructor
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Post::with(['user', 'category'])
            ->latest();
        
        /**
         * Apply search filter
         */
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }
        
        /**
         * Apply category filter (assuming category_id or similar relationship)
         */
        if ($request->has('category') && $request->category != 'all') {
            // If category is ID
            if (is_numeric($request->category)) {
                $query->where('category_id', $request->category);
            } 
            /**
             * If category is slug
             */
            else {
                $query->whereHas('category', function($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }
        }
        
        $posts = $query->paginate($request->get('per_page', 10));
        
        return PostResource::collection($posts);
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