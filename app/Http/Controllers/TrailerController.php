<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trailer; //importante!!
use App\Libro;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\File;

class TrailerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['showTrailerUser', 'showTrailerUserLibro', 'showListaUser']]);
        $this->middleware('auth:admin', ['except' => ['showTrailerUser', 'showTrailerUserLibro', 'showListaUser']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trailers = Trailer::orderByDesc('created_at')->paginate(3);
        return view('trailers.lista', compact('trailers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trailers.crear');
    }

        /**
     * Crear trailer dado un Libro
     * @param  int  $libro_id
     * @return \Illuminate\Http\Response
     */
    public function createWithBook($libro_id)
    {
        if($libro_id!='no_book'){
            $libro = Libro::findOrFail($libro_id);
            return view('trailers.crearConLibro', compact('libro'));
        }else{
            return view('trailers.crear');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $libro_id
     * @return \Illuminate\Http\Response
     */
    use FileUpload;
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'libro' => 'nullable|numeric|unique:App\Trailer,libro_id', // No es requerido el campo 
            'pdf' => 'required|mimes:pdf|max:10000' 
        ]);
        // Create Post
        $trailer = new Trailer;

        // Handle File Upload
        $trailer->pdf = $request->pdf;
        if ($trailer->pdf) {
            try {
                $file = $this->TrailerFileUpload($trailer->pdf);
                $filePath = $file->url;
                $fileExt = $file->ext;
                $trailer->pdf = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                return "error de archivo";
            }
        } else {
            $trailer->pdf = 'noFile';
        }

        $trailer->titulo = $request->input('titulo');
        $trailer->libro_id = $request->libro;
        $trailer->save();
        return redirect()->route('trailers.index')->with('mensaje', 'Trailer Creado!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $libro_id
     * @return \Illuminate\Http\Response
     */
    use FileUpload;
    public function storeWithBook(Request $request, $libro_id)
    {
        $libro = Libro::findOrFail($libro_id);

        if ($libro->trailer) {
            return redirect()->back()->withErrors([
                'El libro ya tiene un trailer'
            ]);
        }

        $request->validate([
            'titulo' => 'required',
            'pdf' => 'required|mimes:pdf|max:10000' //el max no arregla el error porque se rompe antes cuando hace el POST
        ]);
        // Create Post
        $trailer = new Trailer;

        // Handle File Upload
        $trailer->pdf = $request->pdf;
        if ($trailer->pdf) {
            try {
                $file = $this->TrailerFileUpload($trailer->pdf);
                $filePath = $file->url;
                $fileExt = $file->ext;
                $trailer->pdf = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        } else {
            $trailer->pdf = 'noFile';
        }

        $trailer->titulo = $request->input('titulo');
        $trailer->libro_id = $libro_id;
        $trailer->save();
        
        return redirect()->route('libros.show',$libro_id)->with('mensaje', 'Trailer Creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trailer = Trailer::findOrFail($id);
        
        return view('trailers.detalle', compact('trailer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trailer = Trailer::findOrFail($id);
        return view('trailers.editar', compact('trailer'));
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
            'libro' => 'nullable|numeric|unique:App\Trailer,libro_id',
            'pdf' => 'mimes:pdf|max:10000'
        ]);

        $trailer = Trailer::findOrFail($id);

        // Handle File Upload

        if ($request->hasFile('pdf')) {
            try {
                $file = $this->TrailerFileUpload($request->pdf);
                $filePath = $file->url;
                $fileExt = $file->ext;

                if ($trailer->pdf != 'noFile') {
                    File::delete($trailer->pdf);
                }

                $trailer->pdf = $filePath;
            
            } catch (Exception $e) {
                // mensaje de error
                return "error de archivo";
            }
        }

        $trailer->titulo = $request->titulo;
        $trailer->save();

        //if($trailer->libro){
        //    return redirect()->route('libros.show', $trailer->libro->id)->with('mensaje', 'Trailer Actualizado!');
        //}
        return redirect()->route('trailers.index')->with('mensaje', 'Trailer Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trailer = Trailer::findOrFail($id);
        if ($trailer->pdf != 'noFile') {
            File::delete($trailer->pdf);
        }
        $libro_id = $trailer -> libro_id; //guardo el id para volver
        $trailer->delete();

        if($libro_id != 0){
            return redirect()->route('libros.show',$libro_id)->with('mensaje', 'Trailer Eliminado!');
        }else{
            return redirect()->route('trailers.index')->with('mensaje', 'Trailer Eliminado!');
        }
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrailerUser($id) //para Usuarios
    {
        // $libro = Libro::findOrFail($libro_id);
        // $trailer = $libro -> trailer;
        $trailer = Trailer::findOrFail($id);
        return view('trailers.mostrarPDFuser', compact('trailer'));
    }
    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrailerUserLibro($id) //para Usuarios desde libro
    {
        // $libro = Libro::findOrFail($libro_id);
        // $trailer = $libro -> trailer;
        $trailer = Trailer::findOrFail($id);
        return view('trailers.mostrarPDFuser', compact('trailer'));
    }
    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrailerAdmin($id) //para Admin
    {
        $trailer = Trailer::findOrFail($id);
        return view('trailers.mostrarPDFadmin', compact('trailer'));
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showListaUser()
    {
        $trailers = Trailer::orderByDesc('created_at')->paginate(3);

        return view('trailers.user', compact('trailers'));
    }
}
