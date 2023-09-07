<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('service:view');
    }

    public function create(User $user)
    {
        return $user->can('service:create');
    }

    public function update(User $user, Service $service)
    {
        return $user->can('service:update');
    }

    public function delete(User $user, Service $service)
    {
        return $user->can('service:delete');
    }
}
