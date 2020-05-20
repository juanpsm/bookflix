<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Novedad; //importante!!
use App\Traits\ImageUpload;


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
    use ImageUpload; // Uso el Trait creado
    public function store(Request $request)
    {
       // Valido datos
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'image|nullable|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create Post
        $novedad = new Novedad;

        $novedad->imagen = $request->imagen;

        // Handle File Upload
        if ($novedad->imagen) {
            try {
                $filePath = $this->UserImageUpload($novedad->imagen);

                $novedad->imagen = $filePath;
            } catch (Exception $e) {
                // mensaje de error
                "error de imagen";
            }
        }else{
            $novedad->imagen = 'noimage.jpg';
        }



            // // Get filename with the extension
            // $filenameWithExt = $request->file('archivo')->getClientOriginalName();
            // // Get just filename
            // $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // // Get just ext
            // $extension = $request->file('archivo')->getClientOriginalExtension();
            // // Filename to store
            // $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // // Upload Image
            // $path = $request->file('archivo')->storeAs('public/archivos', $fileNameToStore);
        // } else {
        //     $fileNameToStore = 'noimage.jpg';
        // }


        $novedad->titulo = $request->input('titulo');
        $novedad->descripcion = $request->input('descripcion');

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
 // Handle File Upload
 if($request->hasFile('archivo')){
    // Get filename with the extension
    $filenameWithExt = $request->file('archivo')->getClientOriginalName();
    // Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    // Get just ext
    $extension = $request->file('archivo')->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore= $filename.'_'.time().'.'.$extension;
    // Upload Image
    $path = $request->file('archivo')->storeAs('public/archivos', $fileNameToStore);
    // Delete file if exists
    Storage::delete('public/archivos/'.$novedad->archivo);
}

    // Update Post
    $novedad->titulo = $request->input('titulo');
    $novedad->descripcion = $request->input('descripcion');
    if($request->hasFile('archivo')){
    $novedad->archivo = $fileNameToStore;
    }
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
