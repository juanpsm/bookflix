<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
    public function promedioCalificacion()
    {
        return $this->calificaciones()->avg('puntaje');
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
        return $this -> cantidad_capitulos == 1;
    }

    public function esPorCapitulos() {
        return $this -> cantidad_capitulos > 1;
    }

    public function terminadoDeCargar() {
        return ($this -> esCompleto() &&
                $this -> cantCapCargados() == 1 ) ||
                ( $this -> esPorCapitulos() &&
                $this -> cantCapCargados() == $this -> cantidad_capitulos);
    }

    public function recomendados() {
        // Tomamos los generos del libro
        $generos = $this-> generos;
        // creo una colleccion vacía
        $libros_rec = new Collection;
        // voy agregando todos los libros de cada genero
        foreach ($generos as $genero)
        {
            $libros_rec = $libros_rec -> concat($genero-> libros);
        };
        // saco duplicados
        $libros_rec = $libros_rec->unique('id');
        // filtro por calificacion y a si mismo
        $libros_rec = $libros_rec->reject(function ($each) {
            return $each->promedioCalificacion() <= 4 ||
                    $each-> id == $this-> id;
        });

        //$libros_rec = Libro::all();
        //$libros_rec = $libros_rec->reject(function ($each) {
        //    return $each-> id == $this->id;
        //});
        return $libros_rec->slice(0, 6);
    }
    public function tieneRecomendados() {
        return $this -> recomendados() -> count() > 0;
    }

    public function cantComentarios() {
        return $this -> comentarios -> count();
    }

    public function tieneComentarios() {
        return $this -> cantComentarios() > 0;
    }
}
