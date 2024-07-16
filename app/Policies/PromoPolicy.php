<?php

namespace App\Policies;

use App\Promo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Promos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Promos-index');
    }

    /**
     * Determine whether the user can view the Promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function view(User $user, Promo $promo)
    {
        return $user->hasPermissionTo('Promos-view');
    }

    /**
     * Determine whether the user can create Promos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Promos-add');
    }

    /**
     * Determine whether the user can update the Promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function update(User $user, Promo $promo)
    {
        return $user->hasPermissionTo('Promos-edit');
    }

    /**
     * Determine whether the user can delete the Promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function delete(User $user, Promo $promo)
    {
        return $user->hasPermissionTo('Promos-delete');
    }

    /**
     * Determine whether the user can restore the Promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function restore(User $user, Promo $promo)
    {
        return $user->hasPermissionTo('Promos-restore');
    }

    /**
     * Determine whether the user can permanently delete the Promo.
     *
     * @param  \App\User  $user
     * @param  \App\Promo  $promo
     * @return mixed
     */
    public function forceDelete(User $user, Promo $promo)
    {
        return $user->hasPermissionTo('Promos-forceDelete');
    }
}
