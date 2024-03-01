<?php

namespace App\Policies;

use App\Delivery;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any deliveries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('delivery');
    }

    /**
     * Determine whether the user can view the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function view(User $user, Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can create deliveries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function update(User $user, Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can delete the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function delete(User $user, Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can restore the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function restore(User $user, Delivery $delivery)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function forceDelete(User $user, Delivery $delivery)
    {
        //
    }
}
