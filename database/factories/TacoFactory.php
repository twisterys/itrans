<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Taco;
use Faker\Generator as Faker;

$factory->define(Taco::class, function (Faker $faker) {
    return [
        'num_homologation' => $faker->word,
        'marque' => $faker->word,
        'type' => $faker->word,
        'num_serie' => $faker->word,
        'date_validation' => $faker->date(),
        'date_expiration' => $faker->date(),
        'vehicle_id' => factory(\App\Vehicle::class),
    ];
});
