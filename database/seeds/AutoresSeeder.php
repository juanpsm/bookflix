<?php

use Illuminate\Database\Seeder;
use App\Autor;
use Carbon\Carbon;

class AutoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // Autores
    //Autor::truncate();

        // Autor #1
        $autor = new Autor();
        $autor->nombre = "J.R.R. Tolkien";
        $autor->save();
        // Autor #2
        $autor = new Autor();
        $autor->nombre = "Ana Frank";
        $autor->save();
        // Autor #3
        $autor = new Autor();
        $autor->nombre = "Stephen King";
        $autor->save();
        // Autor #4
        $autor = new Autor();
        $autor->nombre = "J.K Rowling";
        $autor->save();
        // Autor #5
        $autor = new Autor();
        $autor->nombre = "Curtis Hewet";
        $autor->save();
        // Autor #6
        $autor = new Autor();
        $autor->nombre = "Isaac Asimov";
        $autor->save();
        // Autor #6
        $autor = new Autor();
        $autor->nombre = "Euclides";
        $autor->save();
        // Autor #7
        $autor = new Autor();
        $autor->nombre = "AutorNoAsignado";
        $autor->save();
    }
}
