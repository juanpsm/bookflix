<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Editorial extends Model
{
    use SoftDeletes;
    protected $table = 'editoriales';

    public function libros(){
        return $this->hasMany(Libro::class);
    }
}
