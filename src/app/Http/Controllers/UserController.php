<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Eloquent\User;

final class UserController extends Controller
{
    public function show(User $user)
    {
        return view('user.show', [
            'user' => $user,
            'posts' => $user->posts()->orderByDesc('created_at')->paginate(25),
        ]);
    }
}
