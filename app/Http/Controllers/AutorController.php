<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autor; //importante!!

class AutorController extends Controller
{
    public function __construct()
    {
        
        
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::paginate(50);
        return view('autores.lista',compact('autores')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autores.crear');
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
            
            'nombre' =>  ['required', 'unique:autores']
        ]);

        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $autor = new Autor();
        $autor->nombre = $request->nombre;
        $autor->save();
    
        return redirect()->route('autores.index')->with('mensaje', 'Autor Creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.detalle', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.editar', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Valido datos
        $autor= Autor::findOrFail($id);
        $request->validate([
            'nombre' => "required|unique:App\Autor,nombre,{$autor->id}"
        ]);

        

        $autor->nombre = $request->nombre;
        //$tarjeta->user_id = auth()->user()->id;
        $autor->save();
    
        return redirect()->route('autores.index')->with('mensaje', 'Autor Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);
        if ($autor->libros()->count() > 0) {
            return back()->with('mensaje', 'Este autor esta en uso');
        }

        $autor->delete();

        return back()->with('mensaje', 'Autor Eliminado!');
    }
}
