<?php

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Resources\PostResource;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


// Route::get('/dashboard', function () {
//     $posts = Post::with([
//         'user:id,name',
//         'comments.user:id,name'
//     ])
//     ->latest()
//     ->take(3)
//     ->get(['id', 'title', 'content', 'created_at', 'user_id']);
    
//     $payload = $posts->map(fn ($post) => [
//         'id' => $post->id,
//         'title' => $post->title,
//         'content' => $post->content,
//         'created_at' => $post->created_at,
//         'author' => [
//             'id' => $post->user?->id,
//             'name' => $post->user?->name ?? 'Unknown',
//         ],
//         'comments' => $post->comments->map(fn ($comment) => [
//             'id' => $comment->id,
//             'body' => $comment->body,
//             'created_at' => $comment->created_at,
//             'user' => [
//                 'id' => $comment->user?->id,
//                 'name' => $comment->user?->name ?? 'Anonymous',
//             ],
//         ]),
//     ]);

//     return Inertia::render('Dashboard', compact('posts'));
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/dashboard', function () {
//     $posts = Post::with([
//         'user:id,name',
//         'comments.user:id,name'
//     ])
//     ->latest()
//     ->take(3)
//     ->get(['id', 'title', 'content', 'created_at', 'user_id']);

//     return Inertia::render('Dashboard', [
//         'posts' => PostResource::collection($posts)->resolve(),
//     ]);

// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', function () {
    $posts = Post::with([
        'user:id,name',
        'comments.user:id,name'
    ])
    ->latest()
    ->take(3)
    ->get();

    return Inertia::render('Dashboard', [
        'posts' => PostResource::collection($posts), 
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/aboutus', [DashboardController::class, 'aboutus'])->name('/Aboutus');
    Route::get('/contactus', [DashboardController::class, 'contactus'])->name('/Contactus');
});


require __DIR__.'/auth.php';
