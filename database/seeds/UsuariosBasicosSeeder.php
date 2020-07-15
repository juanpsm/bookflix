<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Perfil;
use App\Admin;
use App\Autor;
use App\Editorial;
use App\Genero;
use App\Libro;
use App\Novedad;
use App\Trailer;
use App\Capitulo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Traits\FileUpload;

class UsuariosBasicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    // Usuarios
    //User::truncate(); // Evita duplicar datos
    //Perfil::truncate();

        // Estandar ID 1
        DB::table('users')->insert([
            'name' => 'Usuario Estandar',
            'dni' => '11222333',
            'email' => 'estandar@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => false,
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'tarjeta_numero' => '1234123412341234',
            'tarjeta_nombre' => 'Usuario estandar',
            'tarjeta_expiracion' => '12 / 30',
            'tarjeta_cvc' => '123',
        ]);
            // Perfiles para este user
                DB::table('perfiles')->insert([
                    'nombre' => 'Estandar1',
                    'user_id' => 1, // Relación con usuario
                ]);

        // Premium ID 2
        DB::table('users')->insert([
            'name' => 'Usuario Premium',
            'dni' => '22333444',
            'email' => 'premium@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => true,
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'tarjeta_numero' => '1234123412341232', // sin saldo
            'tarjeta_nombre' => 'Usuario premium',
            'tarjeta_expiracion' => '12 / 24',
            'tarjeta_cvc' => '123',
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
        
        // Sin perfiles ID 3
        DB::table('users')->insert([
            'name' => 'Usuario SinPerfiles',
            'dni' => '11000111',
            'email' => 'sinperfiles@bookflix.com',
            'cuenta_activa' => true,
            'es_premium' => false,
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'tarjeta_numero' => '1234123412341234',
            'tarjeta_nombre' => 'Usuario estandar',
            'tarjeta_expiracion' => '12 / 12', // tarjeta vencida
            'tarjeta_cvc' => '123',
        ]);

        // Inactivo ID 4
        DB::table('users')->insert([
            'name' => 'Usuario Inactivo',
            'dni' => '11000222',
            'email' => 'inactivo@bookflix.com',
            'cuenta_activa' => false,
            'es_premium' => false,
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
        ]);

    // Administrador ID 1
    Admin::truncate();

        // Admin 1
        DB::table('admins')->insert([
            'name' => 'admin1',
            'email' => 'admin1@bookflix.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
