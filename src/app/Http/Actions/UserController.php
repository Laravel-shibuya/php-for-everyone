<?php
declare(strict_types=1);

namespace App\Http\Actions;

use App\Domain\Eloquent\User;

final class UserController extends Action
{
    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user,
            'posts' => $user->posts()->orderByDesc('created_at')->paginate(25),
        ]);
    }
}