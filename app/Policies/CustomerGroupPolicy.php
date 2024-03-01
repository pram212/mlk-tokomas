<?php

namespace App\Policies;

use App\CustomerGroup;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class CustomerGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any customer groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('customer_group');
    }

    /**
     * Determine whether the user can view the customer group.
     *
     * @param  \App\User  $user
     * @param  \App\CustomerGroup  $customerGroup
     * @return mixed
     */
    public function view(User $user, CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Determine whether the user can create customer groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the customer group.
     *
     * @param  \App\User  $user
     * @param  \App\CustomerGroup  $customerGroup
     * @return mixed
     */
    public function update(User $user, CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Determine whether the user can delete the customer group.
     *
     * @param  \App\User  $user
     * @param  \App\CustomerGroup  $customerGroup
     * @return mixed
     */
    public function delete(User $user, CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Determine whether the user can restore the customer group.
     *
     * @param  \App\User  $user
     * @param  \App\CustomerGroup  $customerGroup
     * @return mixed
     */
    public function restore(User $user, CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the customer group.
     *
     * @param  \App\User  $user
     * @param  \App\CustomerGroup  $customerGroup
     * @return mixed
     */
    public function forceDelete(User $user, CustomerGroup $customerGroup)
    {
        //
    }
}
