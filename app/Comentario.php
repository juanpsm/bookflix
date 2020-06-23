<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function libro (){
        return $this->belongsTo(Libro::class);
    }
}
