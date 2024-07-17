<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate(['name' => 'Promos-add', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'Promos-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'Promos-delete', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'Promos-index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'Promos-view', 'guard_name' => 'web']);
    }
}
