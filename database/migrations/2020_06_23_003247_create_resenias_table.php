<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReseniasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resenias', function (Blueprint $table) {
            $table->id();
            $table->string('comentario');
            $table->integer('calificacion');
            $table->integer('perfil_id');
            $table->integer('libro_id');
            $table->boolean('es_spoiler')->default(false);
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
        Schema::dropIfExists('resenias');
    }
}
