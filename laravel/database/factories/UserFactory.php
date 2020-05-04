<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
require_once 'vendor/autoload.php';
use App\User;
use Faker\Factory;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$faker = Faker\Factory::create('es_AR');
$factory->define(User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'dni'=> $faker->randomNumber($nbDigits = 8, $strict = true), // 79907610
        'email' => $faker->unique()->freeEmail,
        'email_verified_at' => now(),
        'cuenta_activa' => $faker->boolean,
        'password' => 'aaa', // password de prueba
        'remember_token' => Str::random(10),
    ];
});
