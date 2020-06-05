<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    public function libro (){
        return $this->belongsTo(Libro::class);
    }
}
