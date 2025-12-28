<?php

namespace App\Services\Services;

use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;
use App\Services\Constructors\LikeConstructor;

class LikeService implements LikeConstructor
{
    public function like(LikeRequest $request): LikeResource
    {
        throw new \Exception('Not implemented');
    }
}