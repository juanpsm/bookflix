<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genero extends Model
{
    use SoftDeletes;
    public function libros(){
        return $this->belongsToMany(Libro::class);
    }
}
