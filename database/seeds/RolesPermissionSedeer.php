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
        $role = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $permission = Permission::firstOrCreate(['name' => 'Promos-add', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
        $permission = Permission::firstOrCreate(['name' => 'Promos-edit', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
        $permission = Permission::firstOrCreate(['name' => 'Promos-delete', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
        $permission = Permission::firstOrCreate(['name' => 'Promos-index', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
        $permission = Permission::firstOrCreate(['name' => 'Promos-view', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);
    }
}
