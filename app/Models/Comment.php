<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        "user_id",
        "post_id",
        "content"
    ];

    /**
     * Belong to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belongs to post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
