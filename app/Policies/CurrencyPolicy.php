<?php

namespace App\Policies;

use App\Currency;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class CurrencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any currencies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('currency');
    }

    /**
     * Determine whether the user can view the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function view(User $user, Currency $currency)
    {
        //
    }

    /**
     * Determine whether the user can create currencies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function update(User $user, Currency $currency)
    {
        //
    }

    /**
     * Determine whether the user can delete the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function delete(User $user, Currency $currency)
    {
        //
    }

    /**
     * Determine whether the user can restore the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function restore(User $user, Currency $currency)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the currency.
     *
     * @param  \App\User  $user
     * @param  \App\Currency  $currency
     * @return mixed
     */
    public function forceDelete(User $user, Currency $currency)
    {
        //
    }
}
