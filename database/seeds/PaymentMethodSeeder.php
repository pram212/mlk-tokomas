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
        paymentMethod::create(['name' => 'Cash']);
        paymentMethod::create(['name' => 'Debit Card']);
        paymentMethod::create(['name' => 'Credit Card']);
    }
}
