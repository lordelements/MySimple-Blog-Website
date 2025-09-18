<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Allow all users to view any posts (e.g., a list of posts).
     */
    public function viewAny(User $user = null): bool
    {
        return true;
    }

    /**
     * Allow all users to view a single post.
     */
    public function view(User $user = null, Post $post): bool
    {
        return true;
    }

    /**
     * Only admins can create posts.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Only admins can update any post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Only admins can delete any post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        // This can remain as-is as it's not a user-facing action
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        // This can remain as-is as it's not a user-facing action
        return false;
    }
}