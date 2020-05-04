<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    public function perfil(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
