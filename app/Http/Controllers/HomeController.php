<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genero;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // acá creo que se debería hacer la comprobacion de perfiles en vez de en login y register...

        $generos = Genero::all();
        return view('home', compact('generos'));
    }
}
