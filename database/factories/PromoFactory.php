<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Promo;
use Faker\Generator as Faker;

$factory->define(Promo::class, function (Faker $faker) {
    return [
        'product_properties_id' => function () {
            return factory(App\ProductProperty::class)->create()->id;
        },
        'discount' => $faker->randomFloat(2, 0, 100),
        'start_period' => $faker->dateTimeBetween('-1 months', 'now'),
        'end_period' => $faker->dateTimeBetween('now', '+1 months'),
    ];
});
