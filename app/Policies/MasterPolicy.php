<?php

namespace App\Policies;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function parentView(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-parent');
    }
    public function taggingType(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-tagging');
    }
    public function productProperty(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-product-property');
    }
    public function productType(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-product-tipe');
    }
    public function gramasi(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-gramasi');
    }
    public function price(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-price');
    }
    public function promo(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('master-promo');
    }
}
