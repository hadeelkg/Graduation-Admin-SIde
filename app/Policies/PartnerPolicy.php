<?php

namespace App\Policies;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('partner:view');
    }

    public function create(User $user)
    {
        return $user->can('partner:create');
    }

    public function update(User $user, Partner $partner)
    {
        return $user->can('partner:update');
    }

    public function delete(User $user, Partner $partner)
    {
        return $user->can('partner:delete');
    }
}
