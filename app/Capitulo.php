<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Capitulo extends Model
{
    public function libro (){
        return $this->belongsTo(Libro::class);
    }

    public function vencido() {
        return $this->fecha_de_vencimiento <= Carbon::now()->subDay();
    }

    public function lanzamiento() {
        return Carbon::createFromFormat('Y-m-d', $this-> fecha_de_lanzamiento)->isoFormat("DD \d\\e MMMM \d\\e YYYY");
    }

    public function vencimiento() {
        return Carbon::createFromFormat('Y-m-d', $this-> fecha_de_vencimiento)->isoFormat("DD \d\\e MMMM \d\\e YYYY");
    }

    public function preLanzamiento() {
        return $this->fecha_de_lanzamiento >= Carbon::now();
    }

    public function proximamente() {
        return $this->preLanzamiento();
    }

    public function leido() {
        return session('perfil')->capitulosLeidos()->where('id', $this->id)->exists();
    }
}
