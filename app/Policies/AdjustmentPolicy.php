<?php

namespace App\Policies;

use App\Adjustment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class AdjustmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any adjustments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('adjustment');
    }

    /**
     * Determine whether the user can view the adjustment.
     *
     * @param  \App\User  $user
     * @param  \App\Adjustment  $adjustment
     * @return mixed
     */
    public function view(User $user, Adjustment $adjustment)
    {
        //
    }

    /**
     * Determine whether the user can create adjustments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('adjustment');
    }

    /**
     * Determine whether the user can update the adjustment.
     *
     * @param  \App\User  $user
     * @param  \App\Adjustment  $adjustment
     * @return mixed
     */
    public function update(User $user, Adjustment $adjustment)
    {
        //
    }

    /**
     * Determine whether the user can delete the adjustment.
     *
     * @param  \App\User  $user
     * @param  \App\Adjustment  $adjustment
     * @return mixed
     */
    public function delete(User $user, Adjustment $adjustment)
    {
        //
    }

    /**
     * Determine whether the user can restore the adjustment.
     *
     * @param  \App\User  $user
     * @param  \App\Adjustment  $adjustment
     * @return mixed
     */
    public function restore(User $user, Adjustment $adjustment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the adjustment.
     *
     * @param  \App\User  $user
     * @param  \App\Adjustment  $adjustment
     * @return mixed
     */
    public function forceDelete(User $user, Adjustment $adjustment)
    {
        //
    }
}
