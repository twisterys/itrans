<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exctinteur;
use Faker\Generator as Faker;

$factory->define(Exctinteur::class, function (Faker $faker) {
    return [
        'client' => $faker->word,
        'type_extinteur' => $faker->word,
        'poids' => $faker->randomNumber(),
        'date_last_control' => $faker->date(),
        'date_next_control' => $faker->date(),
        'vehicle_id' => factory(\App\Vehicles::class),
    ];
});
