<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    protected $table = 'editoriales';

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
