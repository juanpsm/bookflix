<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    public function suscripcion(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
