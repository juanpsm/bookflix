<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
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
        $users = User::paginate(50);
        $usersTotal = count(User::all());

        if($request->has('from')){
            $users = User::where('created_at','>=',$request->from)
            ->where('created_at','<=',Carbon::create($request->to)->addDay())
        ->paginate(50);
        }
        return view('estadisticas.users', compact('users'))->with(compact('usersTotal')); 
    }
}
