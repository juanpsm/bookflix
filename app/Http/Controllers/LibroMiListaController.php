<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibroMiListaController extends Controller
{
    public function index() {
        $user = auth()->user();
        $data = [
            'libros' => $this->perfil()->librosMiLista //tengo que pasar miLista no seria libros? 
            //librosMiLista es un nombre que invento recien aca o esta llamado en otro lado????????????
        ];

        return view('libros_miLista.index', $data);
    }
}
