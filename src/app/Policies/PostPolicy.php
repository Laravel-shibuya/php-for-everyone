<?php

namespace App\Policies;

use App\Eloquent\Post;
use App\Eloquent\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Post $post): bool
    {
        return $post->isWrittenBy($user);
    }

    public function destroy(User $user, Post $post): bool
    {
        return $post->isWrittenBy($user);
    }
}
