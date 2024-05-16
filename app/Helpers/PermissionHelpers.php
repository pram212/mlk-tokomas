<?php
namespace App\Helpers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionHelpers
{
    /**
     * Check if the current user's role has permissions for the given menu items.
     *
     * @param array $menu
     * @return array
     */
    public static function checkMenuPermission(array $menu): array
    {
        $user = Auth::user();
        if (!$user) {
            return [];
        }

        $role = Role::find($user->role_id);
        if (!$role) {
            return [];
        }

        // Assuming permissions is a collection of models with a 'name' attribute
        $permissions = $role->permissions->pluck('name')->toArray();

        return array_intersect($menu, $permissions);
    }
}
