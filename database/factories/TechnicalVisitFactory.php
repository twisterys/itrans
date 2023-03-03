<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TechnicalVisit;
use Faker\Generator as Faker;

$factory->define(TechnicalVisit::class, function (Faker $faker) {
    return [
        'ref' => $faker->word,
        'date_last_visit' => $faker->date(),
        'date_next_visit' => $faker->date(),
        'visit_disque' => $faker->word,
        'vignette' => $faker->word,
        'vehicle_id' => factory(\App\Vehicles::class),
    ];
});
