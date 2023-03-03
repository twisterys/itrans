<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'matricule' => $faker->word,
        'categorie' => $faker->word,
        'nom' => $faker->word,
        'prenom' => $faker->word,
        'date_naiss' => $faker->date(),
        'situation_familiale' => $faker->word,
        'nationalite' => $faker->word,
        'cin' => $faker->word,
        'nbre_enfant' => $faker->randomNumber(),
        'tele' => $faker->word,
        'sexe' => $faker->word,
        'nb_deduction' => $faker->randomNumber(),
        'transport' => $faker->word,
        'adress' => $faker->word,
        'ville' => $faker->word,
        'fonction' => $faker->word,
        'section' => $faker->word,
        'date_embauche' => $faker->date(),
        'date_depart' => $faker->date(),
        'salaire_base' => $faker->$faker->randomNumber(),
        'salaire_horaire' => $faker->$faker->randomNumber(),
        'banque' => $faker->word,
        'N_Cmp_Banc' => $faker->word,
        'mode_reglement' => $faker->word,
        'prime_presentation' => $faker->$faker->randomNumber(),
        'prime_panier' => $faker->$faker->randomNumber(),
        'prime_logement' => $faker->$faker->randomNumber(),
        'retraite' => $faker->word,
        'cnss' => $faker->word,
        'date_affiliation' => $faker->date(),
    ];
});
