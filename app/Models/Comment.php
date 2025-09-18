<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
     protected $fillable = ['body', 'user_id', 'post_id'];

     
    // Each comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Each comment belongs to a user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
