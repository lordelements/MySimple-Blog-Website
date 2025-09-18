<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PostService;

class PostController extends Controller
{
    protected $postService;
    
    // Inject the service using Laravel's automatic dependency injection
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
       return $this->postService->indexFromRequest();
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store(Request $request)
    {
        // Only an admin can get past this check
        $this->authorize('create', Post::class);
        
        $this->postService->createFromRequest($request);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return $this->postService->showFromRequest($post);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post); 

        return Inertia::render('Posts/Edit', [
            'post' => $post,
        ]);
        
    }

    public function update(Request $request, Post $post)
    {
        // Only an admin can get past this check
        $this->authorize('update', $post);
        $this->postService->updateFromRequest($request, $post);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        // Only an admin can get past this check
        $this->authorize('delete', $post); 
        $post->delete();
        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
}
