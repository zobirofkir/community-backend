<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;
use App\Services\Constructors\LikeConstructor;
use App\Services\Facades\LikeFacade;
use Illuminate\Http\Request;

class LikeController extends Controller implements LikeConstructor
{
    public function like(LikeRequest $request) 
    {
        return LikeFacade::like($request);
    }
}
