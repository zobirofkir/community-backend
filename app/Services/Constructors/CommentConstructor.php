<?php

namespace App\Services\Constructors;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface CommentConstructor
{
    /**
     * Add new comment
     */
    public function store(CommentRequest $request) : CommentResource;

    /**
     * List all comments
     */
    public function index() : AnonymousResourceCollection;

    /**
     * Show specific comment
     */
    public function show(Comment $comment) : CommentResource;
}