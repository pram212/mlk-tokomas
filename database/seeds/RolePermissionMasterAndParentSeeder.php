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
        //
        $roleMasterAndParent =[
            ['name' => 'products-parent', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'purchase-parent', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'sales-parent', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-parent', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-tagging', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-product-property', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-product-tipe', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-gramasi', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-price', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
            ['name' => 'master-promo', 'guard_name' => 'web', 'created_at' => Date::now(),'updated_at' => Date::now()],
        ];
        foreach($roleMasterAndParent as $value) {
            Permission::insert($value);
        }
    }
}
