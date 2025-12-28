<?php

namespace App\Services\Services;

use App\Http\Requests\LikeRequest;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Services\Constructors\LikeConstructor;

class LikeService implements LikeConstructor
{
    public function like(LikeRequest $request): LikeResource
    {
        $user = $request->user();
        $postId = $request->post_id;
        $type = $request->type; 

        $reaction = Like::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();

        if ($reaction) {
            if ($reaction->type === $type) {
                $reaction->delete();

                return new LikeResource([
                    'status' => 'removed',
                    'type'   => null,
                ]);
            }
            
            /**
             * disable (like <-> dislike)
             */
            $reaction->update([
                'type' => $type,
            ]);

            return new LikeResource($reaction);
        }

        $reaction = Like::create([
            'user_id' => $user->id,
            'post_id' => $postId,
            'type'    => $type,
        ]);

        return new LikeResource($reaction);
    }
}