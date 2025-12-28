<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Services\Constructors\CommentConstructor;
use App\Services\Facades\CommentFacade;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller implements CommentConstructor
{
    /**
     * add new comment
     */
    public function store(CommentRequest $request): CommentResource
    {
        return CommentFacade::store($request);
    }

    /**
     * List all comments
     */
    public function index(Post $post): AnonymousResourceCollection
    {
        return CommentFacade::index($post);
    }

    /**
     * Show specific comment
     */
    public function show(Post $post, Comment $comment): CommentResource
    {
        return CommentFacade::show($post, $comment);
    }
}
