<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Super Admin */
        $super_admin = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web', 'is_active' => 1]);
        $permission_sa = Permission::firstOrCreate(['name' => 'Promos-add', 'guard_name' => 'web']);
        $permission_sa = Permission::firstOrCreate(['name' => 'Promos-edit', 'guard_name' => 'web']);
        $permission_sa = Permission::firstOrCreate(['name' => 'Promos-delete', 'guard_name' => 'web']);
        $permission_sa = Permission::firstOrCreate(['name' => 'Promos-index', 'guard_name' => 'web']);
        $permission_sa = Permission::firstOrCreate(['name' => 'Promos-view', 'guard_name' => 'web']);
        $super_admin->givePermissionTo($permission_sa);

        /* Management */
        $management = Role::firstOrCreate(['name' => 'Management', 'guard_name' => 'web', 'is_active' => 1]);
        $permission_management = [
            'products-index',
            'products-edit',
            'products-add',
            'products-delete',
            'products-buyback-edit',
        ];
        foreach ($permission_management as $permission) {
            // Buat atau dapatkan permission
            $permission_instance = Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);

            // Berikan permission ke role Management
            if (!$management->hasPermissionTo($permission)) {
                $management->givePermissionTo($permission);
            }
        }

        $role = Role::firstOrCreate(['name' => 'Owner', 'guard_name' => 'web', 'is_active' => 1]);
        $role = Role::firstOrCreate(['name' => 'Staff', 'guard_name' => 'web', 'is_active' => 1]);
        $role = Role::firstOrCreate(['name' => 'Customer', 'guard_name' => 'web', 'is_active' => 1]);
        $role = Role::firstOrCreate(['name' => 'Cashier', 'guard_name' => 'web', 'is_active' => 1]);
        $role = Role::firstOrCreate(['name' => 'Kayawan Umum', 'guard_name' => 'web', 'is_active' => 1]);
    }
}
