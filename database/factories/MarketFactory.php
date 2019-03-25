<?php

use Faker\Generator as Faker;

$factory->define(App\Market::class, function (Faker $faker) {
    static $active;

    return [
        'name'        => $faker->company,
        'acronym'     => substr(uniqid(), 10),
        'description' => $faker->sentence(5),
        'active'      => $active ?:
            1,
    ];
});
