<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
require_once 'vendor/autoload.php';
use App\User;
use Carbon\Carbon;
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
    $date = Carbon::now();
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
        'tarjeta_numero' => '1234123412341234',
        'tarjeta_nombre' => $faker->name,
        'tarjeta_expiracion' => '12 / 30',
        'tarjeta_cvc' => '123',
    ];
});
