<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfiles'; // Esto es porque si no busca la table 'perfils' porque hace el plural en ingles.
    public function perfil(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
