<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "user_id",
        "category_id",
        "title",
        "content",
        "views"
    ];

    /**
     * Belongs to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belongs to category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
