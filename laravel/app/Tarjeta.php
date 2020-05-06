<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    public function tarjetas(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
