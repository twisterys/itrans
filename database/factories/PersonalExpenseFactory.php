<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PersonalExpense;
use Faker\Generator as Faker;

$factory->define(PersonalExpense::class, function (Faker $faker) {
    return [
        'frais_auto' => $faker->randomNumber(),
        'frais_tele' => $faker->randomNumber(),
        'frais_gasoil' => $faker->randomNumber(),
        'nbre_days' => $faker->randomNumber(),
        'deplacement' => $faker->randomNumber(),
        'frais_total' => $faker->randomNumber(),
        'import_id' => factory(\App\Import::class),
    ];
});
