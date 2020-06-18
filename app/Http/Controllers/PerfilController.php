<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
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
        $user = auth()->user();
        if (!$user->cuenta_activa) {
            return redirect("elegirSuscripcion");
        }

        $perfiles = $user->perfiles;
        return view('perfiles.lista',compact('perfiles'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function selector()
    {
        $user = auth()->user();
        session(['usuarioId' => $user->id]);

        if (!$user->cuenta_activa) {
            return redirect("elegirSuscripcion");
        }

        $perfiles = $user->perfiles;
        return view('perfiles.seleccionar',compact('perfiles'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function administrar()
    {
        $usuarioId = auth()->user()->id;
        session(['usuarioId' => $usuarioId]);
        $perfiles = Perfil::where('user_id', $usuarioId)->get(); 
        return view('perfiles.administrar',compact('perfiles'));
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

        $exists = Perfil::where('user_id', auth()->user()->id)
            ->where('nombre', $request->nombre)
            ->exists();

        if ($exists) {
            return redirect()->route('perfiles.create')
                ->withInput()
                ->withErrors(['message' => 'Ese nombre de perfil ya esta en uso']);
        }

        $perfil = new Perfil();
        $perfil->nombre = $request->nombre;
        $perfil->user_id = auth()->user()->id;
        $perfil->save();
        
        
        // return redirect()->route('perfiles.setProfile', $perfil);
        return redirect()->route('seleccionar_perfil')->with('mensaje', 'Perfil Creado!');
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
        $perfil = Perfil::findOrFail($id);
        return view('perfiles.editar', compact('perfil'));
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
            'nombre' => "required"
        ]);

        $exists = Perfil::where('user_id', auth()->user()->id)
            ->where('id', '<>', $id)
            ->where('nombre', $request->nombre)
            ->exists();

        if ($exists) {
            return redirect()->route('seleccionar_perfil')->with('mensaje', 'Ese nombre de perfil ya esta en uso');
        }

        $perfil = Perfil::findOrFail($id);
        
        $perfil->nombre = $request->nombre;
        $perfil->user_id = auth()->user()->id;
        $perfil->save();
    
        return redirect()->route('seleccionar_perfil')->with('mensaje', 'Perfil Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $usuarioId = auth()->user()->id;
        $perfiles = Perfil::where('user_id', $usuarioId)->get();

        // return (count($perfiles)>=2);

        if (count($perfiles)>=2)
        {
            $perfil = Perfil::findOrFail($id);
            $perfil->delete();
            
            // return back()->with('mensaje', 'Perfil Eliminado!');
            return redirect()->route('seleccionar_perfil')->with('mensaje', 'Perfil Eliminado!');
        } else {
            //return back()->with('mensaje', 'no puedes eliminar el único perfil!');
            return redirect()->route('seleccionar_perfil')->with('mensaje', 'No puedes eliminar el único perfil!');
        }

    }

    public function storeSessionProfile($id)
    {   
        $perfil = Perfil::findOrFail($id);
        session(['perfil' => $perfil]);
        return redirect(RouteServiceProvider::HOME);

        // test mostrar la session
        // return redirect()->route('session.get');
    }

}

