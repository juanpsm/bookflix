<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero; //importante!!

class GeneroController extends Controller
{

    public function __construct()
    {
        
        //agrego los admin, los users se hacen por otro lado
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Genero::paginate(50);
        return view('generos.lista',compact('generos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('generos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valido datos
        $request->validate([
            
            'nombre' => ['required', 'unique:generos']
        ]);

        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $genero = new Genero();
        $genero->nombre = $request->nombre;
        $genero->save();
    
        return redirect()->route('generos.index')->with('mensaje', 'Género Creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genero = Genero::findOrFail($id);
        return view('generos.detalle', compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genero = Genero::findOrFail($id);
        return view('generos.editar', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genero $genero)
    {
        // Valido datos
        $request->validate([
            'nombre' => "required|unique:App\Genero,nombre,{$genero->id}"
        ]);;

        $genero->nombre = $request->nombre;
        //$tarjeta->user_id = auth()->user()->id;
        $genero->save();
    
        return redirect()->route('generos.index')->with('mensaje', 'Genéro Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $genero = Genero::findOrFail($id);
        $genero->delete();

        return back()->with('mensaje', 'Genéro Eliminado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showGenero($id)
    {
        return $id;
        $genero = Genero::findOrFail($id);
        
        return view('generos.user', compact('genero'));
    }
}
