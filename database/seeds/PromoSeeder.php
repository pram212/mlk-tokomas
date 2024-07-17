<?php

use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Promo::class, 10)->create();
    }
}
