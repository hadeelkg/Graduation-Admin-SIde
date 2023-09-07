<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('blog:view');
    }

    public function create(User $user)
    {
        return $user->can('blog:create');
    }

    public function update(User $user, Blog $blog)
    {
        return $user->can('blog:update');
    }

    public function delete(User $user, Blog $blog)
    {
        return $user->can('blog:delete');
    }
}
