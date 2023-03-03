<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assurance;
use Faker\Generator as Faker;

$factory->define(Assurance::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'expiration' => $faker->date(),
        'assurance_international' => $faker->date(),
        'asseureur' => $faker->word,
        'police' => $faker->word,
        'vehicle_id' => factory(\App\Vehicles::class),
    ];
});
