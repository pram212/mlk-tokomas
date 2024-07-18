<?php

use App\paymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        paymentMethod::firstOrCreate(['name' => 'Cash']);
    }
}
