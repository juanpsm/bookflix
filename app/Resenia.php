<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resenia extends Model
{
    public function libro (){
        return $this->belongsTo(Libro::class);
    }

    public function autor (){ //autor del comentario
        return $this->belongsTo(Perfil::class);
    }

    public function visible (){ //getter para usar en las vistas
        return $this-> es_spoiler;
    }

    // Aca ya dejo para los futuros reportes
    //public function reportes (){ //getter para usar en las vistas
    //    return $this->hasMany(Reportes::class);
    //}

    public function puntaje (){ //getter para usar en las vistas es un nombre alternativo, igual puede usar "$resenia -> calificacion"
        return !$this-> calificacion;
    }

    public function mensaje (){ //getter para usar en las vistas
        return !$this-> comentario;
    }
}
