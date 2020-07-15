<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libro;
use Faker\Generator as Faker;

$factory->define(Libro::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dni'=> $faker->randomNumber($nbDigits = 8, $strict = true), // 79907610
        'email' => $faker->unique()->freeEmail,
        'email_verified_at' => now(),
        'cuenta_activa' => $faker->boolean,
        'password' => '123456', // password de prueba
        'remember_token' => Str::random(10),
        'created_at' =>$date->subWeeks(rand(1, 52)),
        'updated_at' =>Carbon::now(),
    ];
});
