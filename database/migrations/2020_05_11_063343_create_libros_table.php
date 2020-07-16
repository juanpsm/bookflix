<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('portada')->nullable();
            $table->integer('autor_id');
            $table->integer('editorial_id');
            $table->string('isbn');
            $table->date('fecha_de_lanzamiento');
            $table->date('fecha_de_vencimiento');
            $table->boolean('es_completo');
            $table->boolean('terminado_de_cargar')->default(FALSE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
