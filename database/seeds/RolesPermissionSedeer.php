<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionSedeer extends Seeder
{
    public function run()
    {
        // Define roles and their permissions
        $rolesWithPermissions = [
            'Super Admin' => [
                'Promos-add',
                'Promos-edit',
                'Promos-delete',
                'Promos-index',
                'Promos-view',
            ],
            'Management' => [
                'products-index',
                'products-edit',
                'products-add',
                'products-delete',
                'products-buyback-edit',
                'products-stock',
            ],
            // Other roles without specific permissions
            'Owner' => [],
            'Staff' => [],
            'Customer' => [],
            'Cashier' => [],
            'Kayawan Umum' => [],
        ];

        foreach ($rolesWithPermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web', 'is_active' => 1]);

            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'web']);

                if (!$role->hasPermissionTo($permission)) {
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
