<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
