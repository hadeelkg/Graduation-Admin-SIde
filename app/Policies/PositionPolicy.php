<?php

namespace App\Policies;

use App\Models\Position;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('position:view');
    }

    public function create(User $user)
    {
        return $user->can('position:create');
    }

    public function update(User $user, Position $position)
    {
        return $user->can('position:update');
    }

    public function delete(User $user, Position $position)
    {
        return $user->can('position:delete');
    }
}
