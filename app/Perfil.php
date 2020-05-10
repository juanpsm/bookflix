<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Perfil extends Authenticatable
{
    protected $guard = 'profile';

    protected $fillable = [
        'name',
    ];

    protected $table = 'perfiles'; // Esto es porque si no busca la table 'perfils' porque hace el plural en ingles.
    public function user(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }
}
