<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentService
{
    public function storeFromRequest(Request $request)
    {
        $data = $request->validate([
            'body' => 'required|string|max:500', 
            'post_id' => 'required|exists:posts,id',
        ]);

        return Comment::create([
            'body' => $data['body'],
            'post_id' => $data['post_id'],
            'user_id' => Auth::id(),
        ]);
    }
}