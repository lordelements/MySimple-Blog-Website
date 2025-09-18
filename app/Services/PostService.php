<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostService
{
    
    public function indexFromRequest() 
    {
        $posts = Post::with(['user', 'comments.user'])
                ->latest()
                ->paginate(3);

        return Inertia::render('Posts/Index', [
            'posts' => $posts->through(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'created_at' => $post->created_at,
                    'author' => $post->user ? [
                        'id' => $post->user->id,
                        'name' => $post->user->name,
                    ] : [
                        'id' => null,
                        'name' => 'Unknown',
                    ],
                    'comments' => $post->comments->map(function ($comment) {
                        return [
                            'id' => $comment->id,
                            'body' => $comment->body,
                            'created_at' => $comment->created_at,
                            'user' => $comment->user ? [
                                'id' => $comment->user->id,
                                'name' => $comment->user->name,
                            ] : [
                                'id' => null,
                                'name' => 'Anonymous',
                            ],
                        ];
                    }),
                ];
            }),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);

    }

    public function createFromRequest(Request $request): Post
    {
         $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        return Post::create([
            'title'   => $data['title'],
            'content'    => $data['content'],
            'user_id' => Auth::id(),
        ]);
        
    }

    public function updateFromRequest(Request $request, Post $post): Post
    {
       
        $data= $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($data);

        return $post;
    }
    
    public function showFromRequest(Post $post)
    {
        // $post->load('user', 'comments.user');
        $post = Post::with('user', 'comments.user')->findOrFail($post->id);
        

        // return Inertia::render('Posts/Show', [
        //     'post' => [
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'content' => $post->content,
        //         'created_at' => $post->created_at,
        //         'updated_at' => $post->updated_at,
        //         'author' => [
        //             'id' => $post->user->id ?? null,
        //             'name' => $post->user->name ?? 'Unknown',
        //         ],
        //     ],
        //     'comments' => $post->comments->map(function ($comment) {
        //         return [
        //             'id' => $comment->id,
        //             'body' => $comment->body,
        //             'created_at' => $comment->created_at,
        //             'user' => [
        //                 'id' => $comment->user->id ?? null,
        //                 'name' => $comment->user->name ?? 'Anonymous',
        //             ],
        //         ];
        //     }),
        // ]);

        return Inertia::render('Posts/Show', [
            'post' => $post,
            'comments' => $post->comments,
        ]);
    }

}
