<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'total' => $faker->numberBetween(1500, 1000),
        'rfc' => $faker->uuid
    ];
});
