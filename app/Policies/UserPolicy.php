<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view itself.
     *
     * @return mixed
     */
    public function view(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }

    /**
     * Determine whether the user can view itself.
     *
     * @return mixed
     */
    public function edit(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }

    /**
     * Determine whether the user can update itself.
     *
     * @return mixed
     */
    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the user.
     *
     * @return mixed
     */
    public function delete(User $authUser, User $user)
    {
        // return $authUser -> id === $user -> id;
    }
}
