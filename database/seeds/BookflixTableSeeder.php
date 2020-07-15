<?php

use Illuminate\Database\Seeder;

class BookflixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $this->call(UsuariosBasicosSeeder::class);

    $this->call(GenerosSeeder::class);
    $this->call(AutoresSeeder::class);
    $this->call(EditorialesSeeder::class);
    $this->call(LibrosSeeder::class);
    }
}
