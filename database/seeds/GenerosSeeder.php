<?php

use Illuminate\Database\Seeder;
use App\Genero;
use Carbon\Carbon;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generos
        //Genero::truncate();

        // Genero #1
        $genero = new Genero();
        $genero->nombre = "Ciencia Ficción";
        $genero->save();
        // Genero #2
        $genero = new Genero();
        $genero->nombre = "Autobiografía";
        $genero->save();
        // Genero #3
        $genero = new Genero();
        $genero->nombre = "Terror";
        $genero->save();
        // Genero #4
        $genero = new Genero();
        $genero->nombre = "Fantasía";
        $genero->save();
        // Genero #5
        $genero = new Genero();
        $genero->nombre = "Aventura";
        $genero->save();
        // Genero #6
        $genero = new Genero();
        $genero->nombre = "Drama";
        $genero->save();
        // Genero #6
        $genero = new Genero();
        $genero->nombre = "Investigación";
        $genero->save();

        // Genero #7
        $genero = new Genero();
        $genero->nombre = "GeneroNoAsignado";
        $genero->save();

        factory(Genero::class, 10)->create();
    }
}
