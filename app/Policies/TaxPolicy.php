<?php

namespace App\Policies;

use App\Tax;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class TaxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any taxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('tax');
    }

    /**
     * Determine whether the user can view the tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function view(User $user, Tax $tax)
    {
        //
    }

    /**
     * Determine whether the user can create taxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function update(User $user, Tax $tax)
    {
        //
    }

    /**
     * Determine whether the user can delete the tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function delete(User $user, Tax $tax)
    {
        //
    }

    /**
     * Determine whether the user can restore the tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function restore(User $user, Tax $tax)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the tax.
     *
     * @param  \App\User  $user
     * @param  \App\Tax  $tax
     * @return mixed
     */
    public function forceDelete(User $user, Tax $tax)
    {
        //
    }
}
