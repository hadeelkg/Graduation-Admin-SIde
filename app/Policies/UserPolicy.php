<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('user:view');
    }

    public function create(User $user)
    {
        return $user->can('user:create');
    }

    public function update(User $user, User $userModel)
    {
        return $user->can('user:update');
    }

    public function delete(User $user, User $userModel)
    {
        return $user->can('user:delete');
    }
}
