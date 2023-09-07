<?php

namespace App\Policies;

use App\Models\AboutUs;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AboutUsPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return $user->can('about-us:view');
    }

    public function create(User $user)
    {
        return $user->can('about-us:create');
    }

    public function update(User $user, AboutUs $about_u)
    {
        return $user->can('about-us:update');
    }

    public function delete(User $user, AboutUs $about_u)
    {
        return $user->can('about-us:delete');
    }
}
