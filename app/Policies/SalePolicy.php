<?php

namespace App\Policies;

use App\Sale;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any sales.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('sales-index');
    }

    /**
     * Determine whether the user can view the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function view(User $user, Sale $sale)
    {
        //
    }

    /**
     * Determine whether the user can create sales.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('sales-add');
    }

    /**
     * Determine whether the user can update the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function update(User $user, Sale $sale)
    {
        //
    }

    /**
     * Determine whether the user can delete the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function delete(User $user, Sale $sale)
    {
        //
    }

    /**
     * Determine whether the user can restore the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function restore(User $user, Sale $sale)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the sale.
     *
     * @param  \App\User  $user
     * @param  \App\Sale  $sale
     * @return mixed
     */
    public function forceDelete(User $user, Sale $sale)
    {
        //
    }

    public function return(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('returns-index');
    }

    public function report(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('sale-report');
    }

    public function dailyReport(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('daily-sale');
    }

    public function monthlyReport(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('monthly-sale');
    }
}
