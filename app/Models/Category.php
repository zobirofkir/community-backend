<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "title",
        "description"
    ];

    /**
     * Has many posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
