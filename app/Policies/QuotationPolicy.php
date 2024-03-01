<?php

namespace App\Policies;

use App\Quotation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class QuotationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any quotations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('quotes-index');
    }

    /**
     * Determine whether the user can view the quotation.
     *
     * @param  \App\User  $user
     * @param  \App\Quotation  $quotation
     * @return mixed
     */
    public function view(User $user, Quotation $quotation)
    {
        //
    }

    /**
     * Determine whether the user can create quotations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('quotes-add');
    }

    /**
     * Determine whether the user can update the quotation.
     *
     * @param  \App\User  $user
     * @param  \App\Quotation  $quotation
     * @return mixed
     */
    public function update(User $user, Quotation $quotation)
    {
        //
    }

    /**
     * Determine whether the user can delete the quotation.
     *
     * @param  \App\User  $user
     * @param  \App\Quotation  $quotation
     * @return mixed
     */
    public function delete(User $user, Quotation $quotation)
    {
        //
    }

    /**
     * Determine whether the user can restore the quotation.
     *
     * @param  \App\User  $user
     * @param  \App\Quotation  $quotation
     * @return mixed
     */
    public function restore(User $user, Quotation $quotation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the quotation.
     *
     * @param  \App\User  $user
     * @param  \App\Quotation  $quotation
     * @return mixed
     */
    public function forceDelete(User $user, Quotation $quotation)
    {
        //
    }
}
