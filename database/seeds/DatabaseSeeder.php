<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BankSeeder::class,
            PaymentMethodSeeder::class,
            RolesPermissionSedeer::class,
            UsersSedeer::class,
            RolePermissionMasterAndParentSeeder::class,
        ]);
    }
}
