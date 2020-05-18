<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Genero;

class LibroController extends Controller
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
        $libros = Libro::paginate(50);
        return view('libros.lista',compact('libros')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libros.crear');
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
            'autor' => 'required',
            'generos'=> 'required|array'
        ]);

        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $libro = new Libro();
        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor;
        $libro->save();
        $libro->generos()->sync($request->generos);
        // la linea 56 esta creando las relaciones    
        return redirect()->route('libros.index')->with('mensaje', 'Libro Creado!');
    }

    /**
     * Display the specified resource.
     * show($id) como estaba antes
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //$libro = Libro::findOrFail($id);
        //Al poner el parametro como se puede ver ahi, la linea de "findOrFail" laravel
        //la hace automaticamente
        return view('libros.detalle', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        $generos = Genero::all();
        $autores = Autor::all(); //traigo todos los autores de mi sistema
        foreach($libro->generos as $genero){
            foreach($generos as $genero2){
                if($genero2->id == $genero->id){
                    $genero2->selected= true;
                }
            }
        }

        foreach($autores as $autor){
             if($autor->id == $libro->autor_id){
                   $autor->selected= true;
                    break;
             }
        }
        

        return view('libros.editar', compact('libro', "generos", "autores"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
         // Valido datos
         $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'generos'=> 'required|array',
            //'editorial' => 'required'
        ]);

        //$libro = Libro::findOrFail($id); ya no hace falta
        if(Libro::where("titulo", $request->titulo)->where("id","<>",$libro->id)->exists()){
            return redirect()->route('libros.index')->with('mensaje', 'Ya existe un libro con ese titulo!');
        }        
        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor;
        $libro->save();
        $libro->generos()->sync($request->generos);    
        return redirect()->route('libros.index')->with('mensaje', 'libro Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();

        return back()->with('mensaje', 'Libro Eliminado!');
    }
}
