<?php

namespace App\Services\Constructors;

use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;

interface LikeConstructor 
{
    public function like(LikeRequest $request) : LikeResource;
}