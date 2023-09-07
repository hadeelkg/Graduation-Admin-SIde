<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('project:view');
    }

    public function create(User $user)
    {
        return $user->can('project:create');
    }

    public function update(User $user, Project $project)
    {
        return $user->can('project:update');
    }

    public function delete(User $user, Project $project)
    {
        return $user->can('project:delete');
    }
}
