<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ImportItem;
use Faker\Generator as Faker;

$factory->define(ImportItem::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'client' => $faker->word,
        'importateur' => $faker->word,
        'exportateur' => $faker->word,
        'transitaire' => $faker->word,
        'marchandise' => $faker->word,
        'dum' => $faker->word,
        'nbr_colis' => $faker->randomNumber(),
        'poid_brut' => $faker->randomNumber(),
        'observation' => $faker->word,
        'import_id' => factory(\App\Import::class),
    ];
});
