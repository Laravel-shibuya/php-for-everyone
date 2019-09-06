<?php

namespace App\Domain\Policies;

use App\Domain\Eloquent\Post;
use App\Domain\Eloquent\User;
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
