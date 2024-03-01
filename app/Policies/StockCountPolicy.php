<?php

namespace App\Policies;

use App\StockCount;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class StockCountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any stock counts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('stock_count');
    }

    /**
     * Determine whether the user can view the stock count.
     *
     * @param  \App\User  $user
     * @param  \App\StockCount  $stockCount
     * @return mixed
     */
    public function view(User $user, StockCount $stockCount)
    {
        //
    }

    /**
     * Determine whether the user can create stock counts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the stock count.
     *
     * @param  \App\User  $user
     * @param  \App\StockCount  $stockCount
     * @return mixed
     */
    public function update(User $user, StockCount $stockCount)
    {
        //
    }

    /**
     * Determine whether the user can delete the stock count.
     *
     * @param  \App\User  $user
     * @param  \App\StockCount  $stockCount
     * @return mixed
     */
    public function delete(User $user, StockCount $stockCount)
    {
        //
    }

    /**
     * Determine whether the user can restore the stock count.
     *
     * @param  \App\User  $user
     * @param  \App\StockCount  $stockCount
     * @return mixed
     */
    public function restore(User $user, StockCount $stockCount)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the stock count.
     *
     * @param  \App\User  $user
     * @param  \App\StockCount  $stockCount
     * @return mixed
     */
    public function forceDelete(User $user, StockCount $stockCount)
    {
        //
    }
}
