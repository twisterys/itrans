<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'N_immatriculation' => $faker->word,
        'immat_anterieur' => $faker->word,
        'date_pre_mise_circul' => $faker->date,
        'date_m_c_maroc' => $faker->date,
        'date_mutation' => $faker->date,
        'date_debut_validite' => $faker->date,
        'usage' => $faker->word,
        'proprietaire' => $faker->word,
        'adress' => $faker->text,
        'marque' => $faker->randomElement(['Renault','Peugeot']),
        'type' => $faker->word,
        'modele' => $faker->word,
        'genre' => $faker->randomElement(['camion','remorque','contenaire']),
        'num_chassis' => $faker->randomNumber(),
        'type_carburant' => $faker->word,
        'puissance_fiscale' => $faker->randomNumber(),
        'nbr_cylindre' => $faker->randomNumber(),
        'nbr_place' => $faker->randomNumber(),
        'P_T_A_C' => $faker->randomNumber(),
        'poids_a_vide' => $faker->randomNumber(),
        'P_T_M_C_T' => $faker->randomNumber(),
    ];
});
