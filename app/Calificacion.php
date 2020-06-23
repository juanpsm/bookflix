<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';

    public function libro (){
        return $this->belongsTo(Libro::class);
    }

    public function autor (){ //autor del comentario
        return $this->belongsTo(Perfil::class);
    }
}
