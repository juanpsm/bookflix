<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsuariosBasicosSeeder::class,
            UsuariosExtraSeeder::class,
            GenerosSeeder::class,
            AutoresSeeder::class,
            EditorialesSeeder::class,
            LibrosSeeder::class,
        ]);
        //call(BookflixTableSeeder::class);
    }
}
