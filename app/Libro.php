<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';

    public function generos (){
        return $this->belongsToMany(Genero::class); 
        // $this->generos retorna los generos del libro
        // Libro::find(1)->generos retorna los generos del libro con id 1

        // tenemos que crear una tabla en el medio libro_genero donde tiene que tener 2 columnas
        // las cuales son libro_id y genero_id (las dos formarian una llave primaria a lo dbd)


        // IMPORTANTE: LA RELACION TIENE QUE SER CON EL NOMBRE DE LOS MODELOS EN SINGULAR
        // Y ORDENADOS ALFABETICAMENTE!! SI NO NO FUNCA!!
    }

    public function autor (){
        return $this->belongsTo(Autor::class);
    }

    public function editorial (){
        return $this->belongsTo(Editorial::class);
    }

    public function lectores() {
        return $this->belongsToMany(User::class, 'libros_leidos');
    }

    public function usuariosFavorito() {
        return $this->belongsToMany(User::class, 'libros_favoritos');
    }

    public function perfilesMiLista(){
        return $this->belongsToMany(Perfil::class, 'libros_miLista'); //libros_perfil asi se llama en la bd
    }
}
