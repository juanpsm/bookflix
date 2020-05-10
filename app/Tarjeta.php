<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    // por defecto toma la tabla "tarjetas"
    public function user(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
