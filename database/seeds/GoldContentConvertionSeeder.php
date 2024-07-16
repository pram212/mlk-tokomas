<?php

use Illuminate\Database\Seeder;

class GoldContentConvertionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GoldContentConvertion::class, 10)->create();
    }
}
