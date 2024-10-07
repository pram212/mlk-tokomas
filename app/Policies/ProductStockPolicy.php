<?php

namespace App\Policies;

use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductStockPolicy
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
        return $role->hasPermissionTo('product-stock-parent');
    }
    public function productStock(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('product-stock');
    }
}
