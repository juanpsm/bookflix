<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novedad; //importante!!

class NovedadController extends Controller
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
        $novedades = Novedad::paginate(50);
        return view('novedades.lista',compact('novedades')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('novedades.crear');
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
            
        'titulo' => 'required',
        'descripcion' => 'required'
        ]);

        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $novedad = new Novedad();
        $novedad->titulo = $request->titulo;
        $novedad->descripcion = $request->descripcion;
        $novedad->save();
    
        return redirect()->route('novedades.index')->with('mensaje', 'Novedad Creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $novedad = Novedad::findOrFail($id);
        return view('novedades.detalle', compact('novedad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $novedad = Novedad::findOrFail($id);
        return view('novedades.editar', compact('novedad'));
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
         $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required'
        ]);

        $novedad = Novedad::findOrFail($id);

        $novedad->titulo = $request->titulo;
        $novedad->descripcion = $request->descripcion;
        //$tarjeta->user_id = auth()->user()->id;
        $novedad->save();
    
        return redirect()->route('novedades.index')->with('mensaje', 'Novedad Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $novedad = Novedad::findOrFail($id);
        $novedad->delete();

        return back()->with('mensaje', 'Novedad Eliminada!');
    }
}
