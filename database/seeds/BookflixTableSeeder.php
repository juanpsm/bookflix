<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Perfil;
use App\Admin;
use App\Autor;
use App\Editorial;
use App\Genero;
use App\Libro;
use Carbon\Carbon;

class BookflixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => bcrypt('password'),
        // ]);
    User::truncate(); // Evita duplicar datos
    Perfil::truncate();
        DB::table('users')->insert([
            'name' => 'Usuario Estandar',
            'dni' => '11222333',
            'email' => 'estandar@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => false,
            'password' => bcrypt('123456'),
        ]);
                // Perfiles para este user
                DB::table('perfiles')->insert([
                    'nombre' => 'Estandar1',
                    'user_id' => 1, // Relación con usuario
                ]);

        DB::table('users')->insert([
            'name' => 'Usuario Premium',
            'dni' => '22333444',
            'email' => 'premium@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => true,
            'password' => bcrypt('123456'),
        ]);
                // Perfiles para este user
                DB::table('perfiles')->insert([
                    'nombre' => 'Premium1',
                    'user_id' => 2, // Relación con usuario
                ]);
                DB::table('perfiles')->insert([
                    'nombre' => 'Premium2',
                    'user_id' => 2, // Relación con usuario
                ]);
                DB::table('perfiles')->insert([
                    'nombre' => 'Premium3',
                    'user_id' => 2, // Relación con usuario
                ]);
    Admin::truncate();
        DB::table('admins')->insert([
            'name' => 'admin1',
            'email' => 'admin1@bookflix.com',
            'password' => bcrypt('123456'),
        ]);

        // Genero #1
    Genero::truncate();
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
        $genero->nombre = "Drama";
        $genero->save();

        // Autor #1
    Autor::truncate();
        $autor = new Autor();
        $autor->nombre = "Isaac Asimov";
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
        
        // Editorial #1
        $editorial = new Editorial();
        $editorial->nombre = "Gnome Press";
        $editorial->save();
        // Editorial #2
        $editorial = new Editorial();
        $editorial->nombre = "Garbo";
        $editorial->save();
        // Editorial #3
        $editorial = new Editorial();
        $editorial->nombre = "Viking Press";
        $editorial->save();
        // Editorial #4
        $editorial = new Editorial();
        $editorial->nombre = "Bloomsbury Publishing";
        $editorial->save();

    Libro::truncate(); // Evita duplicar datos
        // Libro #1
        $libro = new Libro();
        $libro->titulo = "Yo, Robot";
        $libro->portada = "SS";
        $libro->isbn = "9781234567897";
        $libro->autor_id = 1;
        $libro->editorial_id = 1;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->save();

        $libro->generos()->attach([1, 2]); //Relacionar el libro a dos etiquetas



        //factory(User::class, 5)->create();

        /*
        //Categoria::truncate(); // Evita duplicar datos, los comento por lo de las relaciones

        // $categoria = new Categoria();
        // $categoria->nombre = "Categoría 1";
        // $categoria->save();

        // $categoria = new Categoria();
        // $categoria->nombre = "Categoría 2";
        // $categoria->save();

        // $categoria = new Categoria();
        // $categoria->nombre = "Categoría 3";
        // $categoria->save();

        //comento estas seed porque voy a usar la fabrica
        factory(Categoria::class, 10)->create();

        //Etiqueta::truncate(); // Evita duplicar datos

        $etiqueta = new Etiqueta();
        $etiqueta->nombre = "Etiqueta 1";
        $etiqueta->save();

        $etiqueta = new Etiqueta();
        $etiqueta->nombre = "Etiqueta 2";
        $etiqueta->save();

        //Libro::truncate(); // Evita duplicar datos

        $libro = new Libro();
        $libro->titulo = "Mi primer libro";
        $libro->descripcion = "Extracto de mi primer libro";
        $libro->contenido = "<p>Resumen de mi primer libro</p>";
        $libro->fecha = Carbon::now();
        $libro->categoria_id = 1;
        $libro->save();
        
        $libro->etiquetas()->attach([1, 2]); //Relacionar el libro a dos etiquetas
        
        $libro = new Libro();
        $libro->titulo = "Mi segundo libro";
        $libro->descripcion = "Extracto de mi segundo libro";
        $libro->contenido = "<p>Resumen de mi segundo libro</p>";
        $libro->fecha = Carbon::now();
        $libro->categoria_id = 1;
        $libro->save();

        $libro->etiquetas()->attach([1]); //Relacionar el libro a una etiqueta

        $libro = new Libro();
        $libro->titulo = "Mi tercer libro";
        $libro->descripcion = "Extracto de mi tercer libro";
        $libro->contenido = "<p>Resumen de mi tercer libro</p>";
        $libro->fecha = Carbon::now();
        $libro->categoria_id = 1;
        $libro->save();

        $libro->etiquetas()->attach([2]); //Relacionar el libro a una etiqueta

        */
    }
}
