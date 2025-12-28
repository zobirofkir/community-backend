<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        "user_id",
        "post_id",
        "type"
    ];

    /**
     * Belong to user
     */
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belong to post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
