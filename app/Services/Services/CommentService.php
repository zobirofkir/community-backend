<?php

namespace App\Services\Services;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Services\Constructors\CommentConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentService implements CommentConstructor
{
    /**
     * Add new comment
     */
    public function store(CommentRequest $request): CommentResource
    {
        throw new \Exception('Not implemented');
    }

    /**
     * List all comments
     */
    public function index(): AnonymousResourceCollection
    {
        throw new \Exception('Not implemented');
    }
}