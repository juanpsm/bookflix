<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    // por defecto toma la tabla "tarjetas"
    public function tarjetas(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
