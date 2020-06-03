<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LibrosFavoritosController extends Controller {

    public function index() {
        $user = auth()->user();
        $data = [
            'favoritos' => $this->perfil()->librosFavoritos
        ];

        return view('libros_favoritos.index', $data);
    }
}