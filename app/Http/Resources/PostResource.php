<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'created_at' => $this->created_at,
            'category_id' => $this->category_id,
            'user' => UserResource::make(
                $this->whenLoaded('user')
            ),
            'category' => CategoryResource::make(
                $this->whenLoaded('category')
            ),
            "like" => LikeResource::make($this->likes)
        ];
    }
}
