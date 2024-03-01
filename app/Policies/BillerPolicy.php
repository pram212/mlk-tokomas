<?php

namespace App\Policies;

use App\Biller;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class BillerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any billers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('billers-index');
    }

    /**
     * Determine whether the user can view the biller.
     *
     * @param  \App\User  $user
     * @param  \App\Biller  $biller
     * @return mixed
     */
    public function view(User $user, Biller $biller)
    {
        //
    }

    /**
     * Determine whether the user can create billers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('billers-add');
    }

    /**
     * Determine whether the user can update the biller.
     *
     * @param  \App\User  $user
     * @param  \App\Biller  $biller
     * @return mixed
     */
    public function update(User $user, Biller $biller)
    {
        //
    }

    /**
     * Determine whether the user can delete the biller.
     *
     * @param  \App\User  $user
     * @param  \App\Biller  $biller
     * @return mixed
     */
    public function delete(User $user, Biller $biller)
    {
        //
    }

    /**
     * Determine whether the user can restore the biller.
     *
     * @param  \App\User  $user
     * @param  \App\Biller  $biller
     * @return mixed
     */
    public function restore(User $user, Biller $biller)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the biller.
     *
     * @param  \App\User  $user
     * @param  \App\Biller  $biller
     * @return mixed
     */
    public function forceDelete(User $user, Biller $biller)
    {
        //
    }
}
