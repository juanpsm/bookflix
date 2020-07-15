<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libro;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Libro::class, function (Faker $faker) {
    $date = Carbon::now()->subWeeks(rand(1, 52));
    $cant_capitulos = rand(1, 10);
    $sentence = $faker->sentence(3); // 2,3,4 o 5 palabras 
    return [
        'titulo' => substr($sentence, 0, strlen($sentence) - 1), // le saca el punto
        'portada' => $faker->imageUrl($width = 150, $height = 200),
        'isbn'=> $faker->unique()->isbn10(),
        'autor_id' => factory(App\Autor::class),
        'editorial_id' => rand(2, 15), // son las 15 que creo en el seeder, la 1 es no asignada
        'fecha_de_lanzamiento' => $date = Carbon::now()->addDays(rand(1, 20)),
        'fecha_de_vencimiento' => $date = Carbon::now()->addYears(rand(1, 3)),
        'cantidad_capitulos' => $cant_capitulos,
        'created_at' => $date,
        'updated_at' => $date,
        //'terminado_de_cargar'=> $faker->boolean($chanceOfGettingTrue = 90),
    ];
    
        //$libro->generos()->attach([4, 5]);
});
