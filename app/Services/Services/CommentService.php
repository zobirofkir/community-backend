<?php

namespace App\Services\Services;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\Constructors\CommentConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentConstructor
{
    /**
     * Add new comment
     */
    public function store(CommentRequest $request): CommentResource
    {
        return CommentResource::make(
            Comment::create(
                array_merge(
                    $request->validated(),
                    ['user_id' => Auth::id()]
                )
            )
        );
    }

    /**
     * List all comments
     */
    public function index(): AnonymousResourceCollection
    {
        return CommentResource::collection(
            Comment::all()
        );
    }

    /**
     * Show specific comment
     */
    public function show(Post $post, Comment $comment): CommentResource
    {
        return CommentResource::make($comment);
    }
}