<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSessionData(Request $request)
    {   
        // mostrar solo un att
        // return session('perfil')->nombre;

        // mostrar todo
        return $request->session()->all();

        // mostrar una parte
        if($request->session()->has('name'))
        {
            echo $request->session()->get('name');
        }
        else
        {
            echo 'No data';
        }
    }

    public function storeSessionData(Request $request)
    {
        $request->session()->put('name','Juaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaan');
        echo "data added";
    }

    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('name');
        echo "data removed";
    }
}
