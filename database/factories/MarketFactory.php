<?php

use Faker\Generator as Faker;

$factory->define(App\Market::class, function(Faker $faker) {
    static $active;

    return [
        'name' => $faker->company,
        'description' => $faker->sentence(5),
        'active' => $active ?: 1,
    ];
});
