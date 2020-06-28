<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Libro extends Model
{
    use SoftDeletes;
    protected $table = 'libros';

    protected $casts = [
        'fecha_de_lanzamiento' => 'date',
        'fecha_de_vencimiento' => 'date'
    ];

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

    public function perfiles_historial() {
        return $this->belongsToMany(Perfil::class, 'libros_leidos');
    }
    public function cantHistoriales() {
        return $this->perfiles_historial()->count();
    }

    public function perfiles_favorito() {
        return $this->belongsToMany(Perfil::class, 'libros_favoritos');
    }
    public function cantFavoritos() {
        return $this->perfiles_favorito()->count();
    }

    public function perfiles_miLista(){
        return $this->belongsToMany(Perfil::class, 'libros_miLista'); //libros_perfil asi se llama en la bd
    }
    public function cantMiListas() {
        return $this->perfiles_miLista()->count();
    }

    public function cantLectores() {
        return $this->cantMiListas() + $this->cantHistoriales();
    }

    public function capitulos(){
        return $this->hasMany(Capitulo::class);
    }

    public function trailer(){
        return $this->hasOne(Trailer::class);
    }

    public function inUse() {
        return $this->cantFavoritos() > 0 || 
                $this->cantLectores()  > 0;
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function resenias()
    {
        return $this->hasMany(Renenia::class);
    }

    public function cantCapCargados() {
        return $this-> capitulos -> count();
    }

    public function esCompleto() {
        return $this -> cantidad_de_capitulos == 1;
    }

    public function esPorCapitulos() {
        return $this -> cantidad_de_capitulos > 1;
    }

    public function terminadoDeCargar() {
        return ($this -> esCompleto() &&
                $this -> cantCapCargados() == 1 ) ||
                ( $this -> esPorCapitulos() &&
                $this -> cantCapCargados() == $this -> cantidad_de_capitulos);
    }
}
