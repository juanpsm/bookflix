<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LibrosFavoritosController extends Controller {

    public function index() {
        $user = auth()->user();
        $data = [
            'favoritos' => $user->librosFavoritos
        ];

        return view('libros_favoritos.index', $data);
    }
}