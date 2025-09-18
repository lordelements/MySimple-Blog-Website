<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id'];

    // Post belongs to one user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // public function post()
    // {
    //     return $this->belongsTo(User::class);
    // }
    
}
