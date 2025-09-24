<?php

namespace App\Services;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Storage;

class PostService
{
    
    public function indexFromRequest() 
    {
        $posts = Post::with(['user', 'comments.user'])
                ->latest()
                ->select('id', 'title', 'content', 'filename', 'created_at')
                ->paginate(3);

        return Inertia::render('Posts/Index', [
            'posts' => $posts->through(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'filename' => $post->filename,
                    'file_url' => $post->filename ? Storage::url('posts_uploads/' . $post->filename) : null,
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
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'file'    => 'required|mimes:jpg,jpeg,png,gif,mp4,mov,avi,wmv|max:51200',
        ]);

        $filename = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file->getClientOriginalName());

            // Save file
            $file->storeAs('posts_uploads', $filename, 'public');
        }

        return Post::create([
            'title'    => $data['title'],
            'content'  => $data['content'],
            'filename' => $filename,
            'user_id'  => Auth::id(),
        ]);
    }


    public function updateFromRequest(Request $request, Post $post): Post
    {
       // Validate the incoming request data.
        $data= $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,mp4,mov,avi,wmv|max:51200',
        ]);

        // Handle file upload logic.
        if ($request->hasFile('file')) {

            // Check if there is an old file and delete it to prevent orphaned files.
            if ($post->filename) {
                Storage::disk('public')->delete('posts_uploads/' . $post->filename);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('posts_uploads', $filename, 'public');
            
            $data['filename'] = $filename; 
        } else {
            unset($data['file']);
        }

        $post->update($data);

        return $post;
    }
    
    public function showFromRequest(Post $post)
    {
        // $post->load('user', 'comments.user');
        $post = Post::with('user', 'comments.user')->findOrFail($post->id);
        $post->file_url = $post->filename ? Storage::url('posts_uploads/' . $post->filename) : null;

        return Inertia::render('Posts/Show', [
            'post' => $post,
            'comments' => $post->comments,
        ]);

        // return Inertia::render('Posts/Show', [
        //     'post' => new PostResource($post),
        //     'comments' => CommentResource::collection($post->comments),
        // ]);

    }

}
