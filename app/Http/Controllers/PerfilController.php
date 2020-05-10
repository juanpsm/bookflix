<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //protegemos las rutas
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioId = auth()->user()->id;
        $perfiles = Perfil::where('user_id', $usuarioId)->get();
        return view('perfiles.lista',compact('perfiles'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selector()
    {
        $usuarioId = auth()->user()->id;
        $perfiles = Perfil::where('user_id', $usuarioId)->get(); 
        return view('perfiles.seleccionar',compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('perfiles.crear');
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
            'nombre' => 'required'
        ]);

        $perfil = new Perfil();
        $perfil->nombre = $request->nombre;
        $perfil->user_id = auth()->user()->id;
        $perfil->save();
    
        return redirect()->route('perfiles.index')->with('mensaje', 'Perfil Agregado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'nombre' => 'required'
        ]);

        $perfil = Perfil::findOrFail($id);

        $perfil->nombre = $request->nombre;
        $perfil->user_id = auth()->user()->id;
        $perfil->save();
    
        return redirect()->route('perfiles.index')->with('mensaje', 'Perfil Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->delete();

        return back()->with('mensaje', 'Perfil Eliminado!');
    }
}
