<?php

namespace App\Policies;

use App\Transfer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class TransferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any transfers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('transfers-index');
    }

    /**
     * Determine whether the user can view the transfer.
     *
     * @param  \App\User  $user
     * @param  \App\Transfer  $transfer
     * @return mixed
     */
    public function view(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can create transfers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('transfers-add');
    }

    /**
     * Determine whether the user can update the transfer.
     *
     * @param  \App\User  $user
     * @param  \App\Transfer  $transfer
     * @return mixed
     */
    public function update(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can delete the transfer.
     *
     * @param  \App\User  $user
     * @param  \App\Transfer  $transfer
     * @return mixed
     */
    public function delete(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can restore the transfer.
     *
     * @param  \App\User  $user
     * @param  \App\Transfer  $transfer
     * @return mixed
     */
    public function restore(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the transfer.
     *
     * @param  \App\User  $user
     * @param  \App\Transfer  $transfer
     * @return mixed
     */
    public function forceDelete(User $user, Transfer $transfer)
    {
        //
    }
}
