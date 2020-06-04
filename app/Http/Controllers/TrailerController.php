<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trailer; //importante!!
use App\Traits\FileUpload;
use Illuminate\Support\Facades\File;

class TrailerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['showTrailer']]);
        $this->middleware('auth:admin', ['except' => ['showTrailer']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trailers = Trailer::paginate(50);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    use FileUpload;
    public function store(Request $request)
    {
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
        $trailer->save();
    
        return redirect()->route('trailers.index')->with('mensaje', 'Trailer Creado!');
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
            'pdf' => 'required|mimes:pdf|max:10000'
        ]);

        $trailer = Trailer::findOrFail($id);

        // Handle File Upload

        if ($request->hasFile('pdf')) {
            try {
                $file = $this->TrailersFileUpload($request->pdf);
                $filePath = $file->url;
                $fileExt = $file->ext;

                if (in_array($fileExt, array('pdf'))) {
                    $trailer->es_pdf = true;
                } else {
                    $trailer->es_pdf = false;
                }
                
                if ($trailer->pdf != 'noFile') {
                    File::delete($trailer->pdf);
                }

                $trailer->pdf = $filePath;
            
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        }

        $trailer->titulo = $request->titulo;
        $trailer->save();

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
        $trailer->delete();

        return back()->with('mensaje', 'Trailer Eliminado!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTrailer($id) //para Usuarios
    {
        $trailer = Trailer::findOrFail($id);
        return view('trailers.mostrarPDFuser', compact('trailer'));
    }
    public function showTrailerAdmin($id) //para Admin
    {
        $trailer = Trailer::findOrFail($id);
        return view('trailers.mostrarPDFadmin', compact('trailer'));
    }
}
