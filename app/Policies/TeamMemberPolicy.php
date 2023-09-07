<?php

namespace App\Policies;

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamMemberPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('team-member:view');
    }

    public function create(User $user)
    {
        return $user->can('team-member:create');
    }

    public function update(User $user, TeamMember $member)
    {
        return $user->can('team-member:update');
    }

    public function delete(User $user, TeamMember $member)
    {
        return $user->can('team-member:delete');
    }
}
