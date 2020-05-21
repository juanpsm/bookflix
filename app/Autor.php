<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';

    // esto equivale a hacer select * from libros where autor_id = $this->id

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
