<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected $table = 'suscripciones';

    public function user(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
