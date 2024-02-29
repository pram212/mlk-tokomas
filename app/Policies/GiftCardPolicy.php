<?php

namespace App\Policies;

use App\GiftCard;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class GiftCardPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any gift cards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('gift_card');
    }

    /**
     * Determine whether the user can view the gift card.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function view(User $user, GiftCard $giftCard)
    {
        //
    }

    /**
     * Determine whether the user can create gift cards.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the gift card.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function update(User $user, GiftCard $giftCard)
    {
        //
    }

    /**
     * Determine whether the user can delete the gift card.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function delete(User $user, GiftCard $giftCard)
    {
        //
    }

    /**
     * Determine whether the user can restore the gift card.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function restore(User $user, GiftCard $giftCard)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the gift card.
     *
     * @param  \App\User  $user
     * @param  \App\GiftCard  $giftCard
     * @return mixed
     */
    public function forceDelete(User $user, GiftCard $giftCard)
    {
        //
    }
}
