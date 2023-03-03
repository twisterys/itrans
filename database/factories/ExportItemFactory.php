<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExportItem;
use Faker\Generator as Faker;

$factory->define(ExportItem::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'client' => $faker->word,
        'importateur' => $faker->word,
        'exportateur' => $faker->word,
        'transitaire' => $faker->word,
        'marchandise' => $faker->word,
        'dum' => $faker->word,
        'numb_colis' => $faker->randomNumber(),
        'poid_brute' => $faker->randomNumber(),
        'observ' => $faker->word,
        'export_id' => factory(\App\Export::class),
    ];
});
