<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\GoldContentConvertion;
use Faker\Generator as Faker;

$factory->define(GoldContentConvertion::class, function (Faker $faker) {
    return [
        'tag_types_id' => function () {
            return factory(App\TagType::class)->create()->id;
        },
        'gold_content' => $faker->numberBetween(100, 400),
        'result' => $faker->randomElement(['+-6K', '+-7K', '+-8K']),
    ];
});
