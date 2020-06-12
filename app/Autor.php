<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Autor extends Model
{
    use SoftDeletes;
    protected $table = 'autores';

    // esto equivale a hacer select * from libros where autor_id = $this->id

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
