<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Perfil extends Authenticatable
{
    protected $guard = 'perfil';

    protected $fillable = [
        'name',
    ];

    protected $table = 'perfiles'; // Esto es porque si no busca la table 'perfils' porque hace el plural en ingles.
    public function user(){
        return $this->belongsTo(User::class); //Pertenece a un Usuario.
    }

    public function librosMiLista() {
        return $this->belongsToMany(Libro::class, 'libros_miLista')->withTrashed();
    }

    public function librosLeidos() {
        return $this->belongsToMany(Libro::class, 'libros_leidos')->withTrashed();
    }

    public function capitulosLeidos() {
        return $this->belongsToMany(Capitulo::class, 'capitulos_leidos');
    }

    public function librosFavoritos() {
        return $this->belongsToMany(Libro::class, 'libros_favoritos')->withTrashed();
    }
}
