<?php

namespace App\Policies;

use App\Moneytransfer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class MoneyTransferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any moneytransfers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('money-transfer');
    }

    /**
     * Determine whether the user can view the moneytransfer.
     *
     * @param  \App\User  $user
     * @param  \App\Moneytransfer  $moneytransfer
     * @return mixed
     */
    public function view(User $user, Moneytransfer $moneytransfer)
    {
        //
    }

    /**
     * Determine whether the user can create moneytransfers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the moneytransfer.
     *
     * @param  \App\User  $user
     * @param  \App\Moneytransfer  $moneytransfer
     * @return mixed
     */
    public function update(User $user, Moneytransfer $moneytransfer)
    {
        //
    }

    /**
     * Determine whether the user can delete the moneytransfer.
     *
     * @param  \App\User  $user
     * @param  \App\Moneytransfer  $moneytransfer
     * @return mixed
     */
    public function delete(User $user, Moneytransfer $moneytransfer)
    {
        //
    }

    /**
     * Determine whether the user can restore the moneytransfer.
     *
     * @param  \App\User  $user
     * @param  \App\Moneytransfer  $moneytransfer
     * @return mixed
     */
    public function restore(User $user, Moneytransfer $moneytransfer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the moneytransfer.
     *
     * @param  \App\User  $user
     * @param  \App\Moneytransfer  $moneytransfer
     * @return mixed
     */
    public function forceDelete(User $user, Moneytransfer $moneytransfer)
    {
        //
    }
}
