<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\National;
use Faker\Generator as Faker;

$factory->define(National::class, function (Faker $faker) {
    return [
        'num_EORI' => $faker->randomNumber(),
        'date' => $faker->date(),
        'driver' => $faker->word,
        'mat_camion' => $faker->word,
        'mat_remorque' => $faker->word,
        'mat_contenaire' => $faker->word,
        'compagnie' => $faker->word,
        'navire' => $faker->word,
        'provenance' => $faker->word,
        'destination' => $faker->word,
        'date_arrive' => $faker->date(),
        'date_sortie' => $faker->date(),
        'observation' => $faker->word,
        'tarre' => $faker->randomNumber(),
        'poid_brut' => $faker->randomNumber(),
        'nbr_colis' => $faker->randomNumber(),
        'frais_peage' => $faker->randomNumber(),
        'frais_TMSA' => $faker->randomNumber(),
        'montant_fret' => $faker->randomNumber(),
        'devise' => $faker->randomNumber(),
        'cours' => $faker->word,
        'type' => $faker->word,
    ];
});
