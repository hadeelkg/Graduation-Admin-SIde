<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('comment:view');
    }

    public function create(User $user)
    {
        return $user->can('comment:create');
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->can('comment:delete');
    }
}
