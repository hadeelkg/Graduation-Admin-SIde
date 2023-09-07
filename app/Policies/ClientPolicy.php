<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('client:view');
    }

    public function create(User $user)
    {
        return $user->can('client:create');
    }

    public function update(User $user, Client $client)
    {
        return $user->can('client:update');
    }

    public function delete(User $user, Client $client)
    {
        return $user->can('client:delete');
    }
}
