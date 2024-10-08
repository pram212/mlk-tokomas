<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Spatie\Permission\Models\Permission;

class RolePermissionMasterAndParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleMasterAndParent = [
            ['name' => 'products-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'purchase-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'sales-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-tagging', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-product-property', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-product-tipe', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-gramasi', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-price', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'master-promo', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'product-stock-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'product-stock', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'users-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'report-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'warehouse-transfer', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'action-parent', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'action-add', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'action-edit', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
            ['name' => 'action-delete', 'guard_name' => 'web', 'created_at' => Date::now(), 'updated_at' => Date::now()],
        ];

        foreach($roleMasterAndParent as $value) {
            $exists = Permission::where('name', $value['name'])
                                ->where('guard_name', $value['guard_name'])
                                ->exists();

            if (!$exists) {
                Permission::create($value);
            }
        }
    }
}
