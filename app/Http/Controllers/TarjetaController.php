<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarjeta; //importante!!

class TarjetaController extends Controller
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
        $tarjetas = Tarjeta::where('user_id', $usuarioId)->paginate(10);  // para poner todas get() pero salcar "links" en la vista!
        return view('tarjetas.lista',compact('tarjetas')); // es una sola pero vamos a manejarlo asi por ahora
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarjetas.crear');
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
            'name_on_card' => 'required',
            'card_number' => 'required'
        ]);

        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $tarjeta = new Tarjeta();
        $tarjeta->name_on_card = $request->name_on_card;
        $tarjeta->card_number = $request->card_number;
        $tarjeta->user_id = auth()->user()->id;
        $tarjeta->save();
    
        return redirect()->route('tarjetas.index')->with('mensaje', 'Tarjeta Creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        return view('tarjetas.detalle', compact('tarjeta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        return view('tarjetas.editar', compact('tarjeta'));
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
            'name_on_card' => 'required',
            'card_number' => 'required'
        ]);

        $tarjeta = Tarjeta::findOrFail($id);

        $tarjeta->name_on_card = $request->name_on_card;
        $tarjeta->card_number = $request->card_number;
        $tarjeta->user_id = auth()->user()->id;
        $tarjeta->save();
    
        return redirect()->route('tarjetas.index')->with('mensaje', 'Tarjeta Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarjeta = Tarjeta::findOrFail($id);
        $tarjeta->delete();

        return back()->with('mensaje', 'Tarjeta Eliminada!');
    }
}
