<?php

namespace App\Policies;

use App\Purchase;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class PurchasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any purchases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function parentView(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('purchases-parent');
    }
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('purchases-index');
    }

    /**
     * Determine whether the user can view the purchase.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function view(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can create purchases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('purchases-add');
    }

    /**
     * Determine whether the user can update the purchase.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function update(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can delete the purchase.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function delete(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can restore the purchase.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function restore(User $user, Purchase $purchase)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the purchase.
     *
     * @param  \App\User  $user
     * @param  \App\Purchase  $purchase
     * @return mixed
     */
    public function forceDelete(User $user, Purchase $purchase)
    {
        //
    }

    public function return(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('purchase-return-index');
    }

    public function report(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('purchase-report');
    }

    public function dailyReport(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('daily-purchase');
    }

    public function monthlyReport(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('monthly-purchase');
    }

}
