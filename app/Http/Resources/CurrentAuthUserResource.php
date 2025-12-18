<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentAuthUserResource extends JsonResource
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
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'avatar' => asset('storage/' . $this->avatar),
            'cover' => asset('storage/' . $this->cover),
            'bio' => $this->bio,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
        ];
    }
}
