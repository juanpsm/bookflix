<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    public function libro (){
        return $this->belongsToMany(Libro::class);
        // 
    }
    //falta hacer la funcion del libro para decir que tiene muchos
}
