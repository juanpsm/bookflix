<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Editorial;
use Faker\Generator as Faker;

$factory->define(Editorial::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company,
    ];
});
