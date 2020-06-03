<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LibrosLeidosController extends Controller {

    public function index() {
        $user = auth()->user();
        $data = [
            'leidos' => $this->perfil()->librosLeidos
        ];

        return view('libros_leidos.index', $data);
    }
}