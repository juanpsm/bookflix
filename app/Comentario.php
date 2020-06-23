<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function libro (){
        return $this->belongsTo(Libro::class);
    }

    public function visible (){ //getter para usar en las vistas
        return !$this-> es_spoiler;
    }

    public function autor (){ //autor del comentario
        return $this->belongsTo(Perfil::class);
    }
}
