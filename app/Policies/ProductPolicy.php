<?php

namespace App\Policies;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function parentView(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-parent');
    }
    public function viewAny(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-index');
    }

    public function buybackEdit(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-buyback-edit');
    }

    public function productsStock(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-stock');
    }

    public function view(User $user, Product $product)
    {
        //
    }

    public function create(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-add');
    }

    public function update(User $user, Product $product)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-edit');
    }

    public function delete(User $user, Product $product)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-delete');
    }

    public function restore(User $user, Product $product)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('products-restore');
    }

    public function forceDelete(User $user, Product $product)
    {
        //
    }

    public function printBarcode(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('print_barcode');
    }

    public function report(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('purchase-report');
    }

    public function viewProdukQtyAlert(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('product-qty-alert');
    }
    public function viewActionButton(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('action-parent');
    }
    public function viewActionButtonAdd(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('action-add');
    }
    public function viewActionButtonEdit(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('action-edit');
    }
    public function viewActionButtonDelete(User $user)
    {
        $role = Role::find($user->role_id);
        return $role->hasPermissionTo('action-delete');
    }

}
