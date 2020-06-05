<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libro;
use App\Genero;
use App\Autor;
use App\Editorial;

use App\Traits\FileUpload;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;

class LibroController extends Controller
{
    public function __construct()
    {
        // esto hace que solo un usuario logueado pueda acceder
        $this->middleware('auth', ['only' => []]);
        // y esto hace que solo un admin pueda acceder a estas funciones
        $this->middleware('auth:admin', ['only' => ['index','show','create', 'store', 'edit', 'delete']]);
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
    use FileUpload; // Uso el Trait creado
    public function store(Request $request)
    {
        // Valido datos
        $request->validate([
            'titulo' => 'required|unique:App\Libro',
            'isbn' => 'required|unique:App\Libro',
            'fecha_de_lanzamiento' => 'required|date_format:Y-m-d',
            'fecha_de_vencimiento' => 'required|date_format:Y-m-d|after:fecha_de_lanzamiento',
            'autor' => 'required',
            'generos'=> 'required|array',
            'editorial' => 'required',
            'portada' => 'nullable|mimes:jpeg,png,jpg,gif|max:41000'
        ]);
        
        //esto mismo se puede resolver con un simple unique
        /*
        if(Libro::where("titulo", $request->titulo)->exists()){
            return redirect()->route('libros.index')->with('mensaje', 'Ya existe un libro con ese titulo!');
        }  

        if(Libro::where("isbn", $request->isbn)->exists()){
            return redirect()->route('libros.index')->with('mensaje', 'Ya existe un libro con ese ISBN!');
        }*/ 
        
        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $libro = new Libro();

        // Handle File Upload
        $libro->portada = $request->portada;
        if ($libro->portada) {
            try {
                $file = $this->PortadaFileUpload($libro->portada);
                $filePath = $file->url;
                $fileExt = $file->ext;

                $libro->portada = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        } else {
            $libro->portada = 'noFile';
        }

        $libro->titulo = $request->titulo;
        $libro->autor_id = $request->autor;
        $libro->editorial_id = $request->editorial;
        $libro->isbn = $request->isbn;
        $libro->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $libro->fecha_de_vencimiento = $request->fecha_de_vencimiento;
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
        $editoriales = Editorial::all();
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

        foreach($editoriales as $editorial){
            if($editorial->id == $libro->editorial_id){
                  $editorial->selected= true;
                   break;
            }
       }
        

        return view('libros.editar', compact('libro', "generos", "autores", "editoriales"));
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
            'titulo' => 'required|unique:App\Libro',
            'isbn' => 'required|unique:App\Libro',
            'fecha_de_lanzamiento' => 'required|date_format:Y-m-d',
            'fecha_de_vencimiento' => 'required|date_format:Y-m-d|after:fecha_de_lanzamiento',
            'autor' => 'required',
            'generos'=> 'required|array',
            'editorial' => 'required',
            'portada' => 'nullable|mimes:jpeg,png,jpg,gif|max:41000'
        ]);

        //$libro = Libro::findOrFail($id); ya no hace falta
        // Handle File Upload
        if ($request->hasFile('portada')) {
            try {
                $file = $this->PortadaFileUpload($request->portada);
                $filePath = $file->url;
                $fileExt = $file->ext;
                
                if ($novedad->archivo != 'noFile') {
                    File::delete($novedad->archivo);
                }
                $libro->portada = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        }
        
        //mirar los nombres de la tabla de migraciones y los nombres del formulario!!
        $libro->titulo = $request->titulo; // asigno en el campo titulo lo que ingrese en el formulario
        $libro->autor_id = $request->autor;
        $libro->editorial_id = $request->editorial;
        $libro->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $libro->fecha_de_vencimiento = $request->fecha_de_vencimiento;
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
        if ($libro->portada != 'noFile') {
            File::delete($libro->portada);
        }
        $libro->delete();

        return back()->with('mensaje', 'Libro Eliminado!');
    }

    public function showForUser(Libro $libro) {
        return view('libros.libro', [
            'libro' => $libro,
            'isFavorite' => $this->perfil()
                ->librosFavoritos()
                ->where('libro_id', $libro->id)
                ->exists(),
            'isInMyList' => $this->perfil()
             ->librosMiLista()
             ->where('libro_id', $libro->id)
             ->exists()    
        ]);
    }

    public function toggleFavorite(Libro $libro) {
        $this->perfil()->librosFavoritos()->toggle([$libro->id]);

        return back();
    }


    public function search(Request $request) {
        if ($q = $request->input('q')) {
            return Libro::where('titulo', 'LIKE', "%{$q}%")
            /* esto permite encontrar los libros ingresando el autor o la editorial

            ->orWhereHas('autor', function (Builder $query)use($q) {
                $query->where('nombre', 'like', "%{$q}%");
            })
            ->orWhereHas('editorial', function (Builder $query)use($q) {
                $query->where('nombre', 'like', "%{$q}%");
            }) */
                ->orderBy('titulo')
                ->limit($request->input('limit') ?? 8)
                ->get();
        }
        return Libro::all();
    }
}
