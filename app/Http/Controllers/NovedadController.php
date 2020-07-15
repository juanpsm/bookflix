<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novedad; //importante!!
use App\Traits\FileUpload;
use Illuminate\Support\Facades\File;

class NovedadController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => ['showNovedadGuest']]);
        $this->middleware('auth', ['only' => ['showNovedad']]);
        $this->middleware('auth:admin', ['except' => ['showNovedad', 'showNovedadGuest']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $novedades = Novedad::paginate(5);
        return view('novedades.lista', compact('novedades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $now =Carbon::now(); esto seria si no uso el date para los input de fecha
       //lo deje comentado porque quizas sirva  en este caso o en un futuro
        return view('novedades.crear');//->whit('now');
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
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha_de_publicacion' => 'required|date|date_format:Y-m-d\TH:i:s|after:yesterday|max:2038-01-19T00:00:00',
            'archivo' => 'nullable|mimes:jpeg,png,jpg,gif,mp4|max:41000' //el max no arregla el error porque se rompe antes cuando hace el POST
            // 'archivo' => 'image|nullable|mimes:jpeg,png,jpg,gif,mp4|max:2048',
            // 'video' => 'video|nullable|mimes:mp4'
        ]);

        // Create Post
        $novedad = new Novedad;

        // Handle File Upload
        $novedad->archivo = $request->archivo;
        if ($novedad->archivo) {
            try {
                $file = $this->NovedadFileUpload($novedad->archivo);
                $filePath = $file->url;
                $fileExt = $file->ext;

                if (in_array($fileExt, array('png','jpeg','png','jpg','gif'))) {
                    $novedad->es_video = false;
                } elseif ($fileExt == 'mp4') {
                    $novedad->es_video = true;
                }

                $novedad->archivo = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        } else {
            $novedad->archivo = 'noFile';
        }

        $novedad->titulo = $request->input('titulo');
        $novedad->descripcion = $request->input('descripcion');
        $novedad->fecha_de_publicacion = $request->input('fecha_de_publicacion');

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
            'descripcion' => 'required',
            'archivo' => 'nullable|mimes:jpeg,png,jpg,gif,mp4|max:41000'
        ]);

        $novedad = Novedad::findOrFail($id);

        // Handle File Upload

        if ($request->hasFile('archivo')) {
            try {
                $file = $this->NovedadFileUpload($request->archivo);
                $filePath = $file->url;
                $fileExt = $file->ext;

                if (in_array($fileExt, array('png','jpeg','png','jpg','gif'))) {
                    $novedad->es_video = false;
                } else {
                    $novedad->es_video = true;
                }
                
                if ($novedad->archivo != 'noFile') {
                    File::delete($novedad->archivo);
                }

                $novedad->archivo = $filePath;
            
            } catch (Exception $e) {
                // mensaje de error
                "error de archivo";
            }
        }

        $novedad->titulo = $request->titulo;
        $novedad->descripcion = $request->descripcion;
        $novedad->fecha_de_publicacion = $request->input('fecha_de_publicacion');

        $novedad->save();

        //if($request->hasFile('archivo')){
        
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
        if ($novedad->archivo != 'noFile') {
            File::delete($novedad->archivo);
        }
        $novedad->delete();

        return back()->with('mensaje', 'Novedad Eliminada!');
    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showNovedad()
    {
        $novedades = Novedad::
            where('fecha_de_publicacion', '<', now())
            ->orderByDesc('fecha_de_publicacion')
            ->paginate(5);

        return view('novedades.user', compact('novedades'));
    }

    public function showNovedadGuest() {
        return $this->showNovedad();
    }
}
