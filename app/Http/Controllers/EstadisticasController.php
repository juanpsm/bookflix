<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Perfil;
use App\Libro;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class EstadisticasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $usersTotal
     * @return \Illuminate\Http\Response
     */
    public function users(Request $request)
    {
        $users = User::orderByDesc('created_at')->paginate(10);
        $usersTotal = count(User::all());

        if($request->has('desde')){

            $request->validate([
                'desde' => 'required|date_format:Y-m-d',
                'hasta' => 'required|date_format:Y-m-d|after_or_equal:desde'
            ]);
            $users = User::where('created_at','>=',$request->desde)
            ->where('created_at','<=',Carbon::create($request->hasta)->addDay())
            ->orderByDesc('created_at')->paginate(10);
        }
        return view('estadisticas.users', compact('users'))->with(compact('usersTotal')); 
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $usersTotal
     * @return \Illuminate\Http\Response
     */
    public function libros(Request $request)
    {
        $perfilesTotal = count(Perfil::all());
        $libros = Libro::withTrashed()->get();
        $libros = $libros->sortByDesc(function($libro){return $libro->cantLectores();});
        //$libros = $libros->paginate(50);
        // No se puede usar paginate ya que al usar el sortBy me transformó en una coleccion
        // asi que lo hago a mano
        // $libros = $libros -> toArray();
        // $total=count($libros);
        // $per_page = 50;
        // $current_page = $request->input("page") ?? 1;
        // $starting_point = ($current_page * $per_page) - $per_page;
        // $libros = array_slice($libros, $starting_point, $per_page, true);
        // $libros = new Paginator($libros, $per_page, $current_page, [
        //     'path' => $request->url(),
        //     'query' => $request->query(),
        // ]);
        // no funciona porque ya no es un objeto

        // así funciona con los links pero ordena mal (solo por historiales)
        $libros = Libro::withTrashed()->withCount('perfiles_historial')->orderBy('perfiles_historial_count', 'desc')->paginate(10);
        return view('estadisticas.libros', compact('libros'))->with(compact('perfilesTotal')); 
    }
}
