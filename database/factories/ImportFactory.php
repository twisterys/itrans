<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Import;
use Faker\Generator as Faker;

$factory->define(Import::class, function (Faker $faker) {
    return [
        'manifeste' => $faker->word,
        'num_EORI' => $faker->randomNumber(),
        'date' => $faker->date(),
        'num_connaissement' => $faker->randomNumber(),
        'driver' => $faker->word,
        'mat_camion' => $faker->word,
        'mat_remorque' => $faker->word,
        'mat_contenaire' => $faker->word,
        'compagnie' => $faker->word,
        'navire' => $faker->word,
        'provenance' => $faker->word,
        'destination' => $faker->word,
        'date_arrivée' => $faker->date(),
        'date_sortie' => $faker->date(),
        'observation' => $faker->word,
        'tarre' => $faker->randomNumber(),
        'poid_brut' => $faker->randomNumber(),
        'nbr_colis' => $faker->randomNumber(),
        'devise' => $faker->randomNumber(),
        'type' => $faker->word,
    ];
});
