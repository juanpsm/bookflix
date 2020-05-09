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
            $table->bigIncrements('id');
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
            // en realidad es solo para probar dado que no es seguro almacenar esta
            // informacion en el servidor de la app, para eso existen paquetes tipo de 
            // Paypal que se encargan de manejar esta informacion de forma segura.
            // 
            $table->bigIncrements('id');
            $table->string('name_on_card')->nullable();
            $table->string('card_number');
            $table->string('security_code')->nullable();
            // si lo pongo en date me da error porque nullable no es 
            // lo mismo que no existente y el campo date si esta hay que mandarlo
            // parece, aunque sea un null, pero no quiero hardcodear ahora un null
            // que igualmente se va a hacer de otra manera después.
            // Si queremos hacerlo asi nomas luego hay que ver al tomar los datos 
            // del formulario de poner un dia y hora por defecto
            // por ejemplo la medianoche del primer dia de cada mes
            $table->string('expiration_date')->nullable();
            // Billing address
            $table->string('fullname')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('postal_code')->nullable();

            $table->unsignedBigInteger('user_id'); // Relación con usuario (ojo el tipo de dato)
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
