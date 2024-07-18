<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_id_for_management = Role::where('name', 'Management')->first()->id;

        // Check if the user already exists
        $user_management = User::firstOrCreate([
            'email' => 'management@gmail.com',
        ], [
            'name' => 'Management',
            'password' => bcrypt('password'),
            'phone' => '081234567890',
            'role_id' => $role_id_for_management,
            'is_active' => 1,
            'is_deleted' => 0,
        ]);
    }
}
