<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Capitulo; //importante!!
use App\Libro;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\File;

class CapituloController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth', ['only' => ['showCapitulo', 'showCapitulos']]);
        //$this->middleware('auth:admin', ['except' => ['showCapitulo']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capitulos = Capitulo::paginate(50);
        return view('capitulos.lista', compact('capitulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('capitulos.crear');
    }

        /**
     * Crear capitulo dado un Libro
     * @param  int  $libro_id
     * @return \Illuminate\Http\Response
     */
    public function createWithBook($libro_id)
    {
        $libro = Libro::findOrFail($libro_id);
        return view('capitulos.crear', compact('libro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $libro_id
     * @return \Illuminate\Http\Response
     */
    use FileUpload;
    public function store(Request $request, $libro_id)
    {
        $libro= Libro::findOrFail($libro_id);
        $request->validate([
            'titulo' => 'required',
            'fecha_de_lanzamiento' => "required|date_format:Y-m-d|after_or_equal:{$libro->fecha_de_lanzamiento}",
            'fecha_de_vencimiento' => "required|date_format:Y-m-d|after:fecha_de_lanzamiento|before_or_equal:{$libro->fecha_de_vencimiento}",
            'pdf' => 'required|mimes:pdf|max:10000' //el max no arregla el error porque se rompe antes cuando hace el POST
        ]);

        // Create Post
        $capitulo = new Capitulo;

        // Handle File Upload
        $capitulo->pdf = $request->pdf;
        if ($capitulo->pdf) {
            try {
                $file = $this->CapituloFileUpload($capitulo->pdf);
                $filePath = $file->url;
                $fileExt = $file->ext;
                $capitulo->pdf = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        } else {
            $capitulo->pdf = 'noFile';
        }

        
        $capitulo->titulo = $request->input('titulo');
        $capitulo->libro_id = $libro_id;
        $capitulo->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $capitulo->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        $capitulo->save();
    
        return redirect()->route('libros.show',$libro_id)->with('mensaje', 'Capitulo Creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        
        return view('capitulos.detalle', compact('capitulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        return view('capitulos.editar', compact('capitulo'));
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
        $capitulo = Capitulo::findOrFail($id);
        $libro= Libro::findOrFail($capitulo->libro_id);
        $request->validate([
            'titulo' => 'required',
            'fecha_de_lanzamiento' => "required|date_format:Y-m-d|after_or_equal:{$libro->fecha_de_lanzamiento}",
            'fecha_de_vencimiento' => "required|date_format:Y-m-d|after:fecha_de_lanzamiento|before_or_equal:{$libro->fecha_de_vencimiento}",
            'pdf' => 'mimes:pdf|max:10000' //el max no arregla el error porque se rompe antes cuando hace el POST
        ]);

        // Handle File Upload

        if ($request->hasFile('pdf')) {
            try {
                $file = $this->CapituloFileUpload($request->pdf);
                $filePath = $file->url;
                $fileExt = $file->ext;

                if ($capitulo->pdf != 'noFile') {
                    File::delete($capitulo->pdf);
                }

                $capitulo->pdf = $filePath;
            
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        }

        $capitulo->titulo = $request->titulo;
        $capitulo->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $capitulo->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        $capitulo->save();

        return redirect()->route('libros.show', $capitulo->libro->id)->with('mensaje', 'Capitulo Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        if ($capitulo->pdf != 'noFile') {
            File::delete($capitulo->pdf);
        }
        $id = $capitulo -> libro -> id; //guardo el id para volver
        $capitulo->delete();

        return redirect()->route('libros.show',$id)->with('mensaje', 'Capitulo Eliminado!');
    }

    /**
     * Ver lista de capitulos para el usuario
     *
     * @param  int  $id_libro
     * @return \Illuminate\Http\Response
     */
    public function showCapitulos($id_libro)
    {
        $libro = Libro::findOrFail($id_libro);
        $capitulos = $libro->capitulos; // tambien funca $libro->capitulos()->get()
        return view('capitulos.user', compact('capitulos'), [
            'libro' => $libro,
            'perfil' => $this->perfil(),
            'isFavorite' => $this->perfil()
                ->librosFavoritos()
                ->where('libro_id', $libro->id)
                ->exists(),
            'isInMyList' => $this->perfil()
                ->librosMiLista()
                ->where('libro_id', $libro->id)
                ->exists(),
            'leido' => $this->perfil()
                ->librosLeidos()
                ->where('libro_id', $libro->id)
                ->exists()
        ]);
    }

    /**
     * Mostrar el pdf de un capitulo de un libro para Usuarios
     *
     * @param  int  $libro_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function capituloReader($libro_id, $id)
    {   
        $capitulo = Capitulo::findOrFail($id);
        
        $libro = $capitulo -> libro;
        // Otras formas de obtener el libro:
        // $libro = $capitulo -> libro() -> get();
        //$libro = Libro::findOrFail($capitulo -> libro_id);
        //
        $this->perfil()->librosMiLista()->syncWithoutDetaching([$libro->id]);
        return view('capitulos.mostrarPDFuser', compact('capitulo'), [
            'libro' => $libro,
            'isFavorite' => $this->perfil()
                ->librosFavoritos()
                ->where('libro_id', $libro->id)
                ->exists(),
            'isInMyList' => $this->perfil()
                ->librosMiLista()
                ->where('libro_id', $libro->id)
                ->exists(),
            'leido' => $this->perfil()
                ->capitulosLeidos()
                ->where('capitulo_id', $capitulo->id)
                ->exists()
        ]);
    }
    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCapituloAdmin($id) //para Admin
    {
        $capitulo = Capitulo::findOrFail($id);
        return view('capitulos.mostrarPDFadmin', compact('capitulo'));
    }

    /**
     *
     * @param  int  $libro_id
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function marcarLeido($libro_id, $id)
    {
        $libro = Libro::findOrFail($libro_id);
        $capitulo = Capitulo::findOrFail($id);

        $this->perfil()->capitulosLeidos()->syncWithoutDetaching($capitulo->id);

        $leidos = $this->perfil()->capitulosLeidos->filter(function($value, $key) use ($libro) {
            return $value->libro_id === $libro->id;
        })->count();
        $totales = $libro->capitulos()->count();
        if ($leidos == $totales) {
            $this->perfil()->librosLeidos()->syncWithoutDetaching($libro->id);
            $this->perfil()->librosMiLista()->detach($libro->id);
        }

        return redirect()->route('libro.capitulos', $libro->id);
    }
}
