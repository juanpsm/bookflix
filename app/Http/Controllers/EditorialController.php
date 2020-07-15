<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editorial;

class EditorialController extends Controller
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
        $editoriales = Editorial::paginate(5);
        return view('editoriales.lista',compact('editoriales')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editoriales.crear');
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
            
                    'nombre' => 'required|unique:App\Editorial'
                ]);
        
                //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
                $editorial = new Editorial();
                $editorial->nombre = $request->nombre;
                $editorial->save();
            
                return redirect()->route('editoriales.index')->with('mensaje', 'Editorial Creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editorial = Editorial::findOrFail($id);
        return view('editoriales.detalle', compact('editorial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editorial = Editorial::findOrFail($id);
        return view('editoriales.editar', compact('editorial'));
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
                $editorial= Editorial::findOrFail($id);
                $request->validate([
                    'nombre' => "required|unique:App\Editorial,nombre,{$editorial->id}"
                ]);
        
        
                $editorial->nombre = $request->nombre;
                //$tarjeta->user_id = auth()->user()->id;
                $editorial->save();
            
                return redirect()->route('editoriales.index')->with('mensaje', 'Editorial Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editorial = Editorial::findOrFail($id);
        
        if ($editorial->libros()->count() > 0) {
            return back()->with('mensaje', 'Esta editorial esta en uso');
        }

        $editorial->delete();

        return back()->with('mensaje', 'Editorial Eliminado!');
    }
}
