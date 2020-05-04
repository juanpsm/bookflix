<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('users', function (Blueprint $table) {
            $table->id();//increments('id'); ???
            $table->string('name');
            $table->unsignedBigInteger('dni');
            $table->string('email')->unique();
            $table->boolean('cuenta_activa')->default($value = true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tarjetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('numero');
            $table->string('emisor');
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea para que se haga relac a nivel de bd
            $table->timestamps();
        }); // como la tarjeta aparece en usuario tiene que hacerse primero
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('fecha_inicio')->nullable();// los dejo nulos temporalmete
            $table->timestamp('fecha_fin')->nullable();
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
            $table->timestamps();
        }); 
        Schema::create('perfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icono')->nullable();// luego vemos como hacemos el icono
            $table->string('nombre'); //creo que no es necesario que sea unico ni nada esto.
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->foreign('user_id')->references('id')->on('users'); // clave foranea
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarjetas');
        Schema::dropIfExists('suscripciones');
        Schema::dropIfExists('perfiles');
        Schema::dropIfExists('users');// primero eliminar las referencias
    }
}
