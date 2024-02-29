<?php

namespace App\Policies;

use App\User;
use App\Warehouse;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class WarehousePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any warehouses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('warehouse');
    }

    /**
     * Determine whether the user can view the warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function view(User $user, Warehouse $warehouse)
    {
        //
    }

    /**
     * Determine whether the user can create warehouses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function update(User $user, Warehouse $warehouse)
    {
        //
    }

    /**
     * Determine whether the user can delete the warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function delete(User $user, Warehouse $warehouse)
    {
        //
    }

    /**
     * Determine whether the user can restore the warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function restore(User $user, Warehouse $warehouse)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the warehouse.
     *
     * @param  \App\User  $user
     * @param  \App\Warehouse  $warehouse
     * @return mixed
     */
    public function forceDelete(User $user, Warehouse $warehouse)
    {
        //
    }
    
    public function report(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('warehouse-report');
    }

    public function stockReport(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('warehouse-stock-report');
    }

    
}
