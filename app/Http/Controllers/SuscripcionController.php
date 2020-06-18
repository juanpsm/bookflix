<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use Illuminate\Http\Request;
use Auth;
use Session;

class SuscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->cuenta_activa) {
            return redirect('/home');
        }

        return view('suscripciones.index');
    }

    public function elegirSuscripcion(Request $request) {
        $user = auth()->user();

        $vData = $request->validate([
            'tipoCuenta' => 'required'
        ]);

        $esPremium = $vData['tipoCuenta'] == 'premium';

        if ($user->cuenta_activa) {
            abort(400, 'La cuenta tiene una suscripcion activa');
        }
        
        if (!$esPremium && $user->perfiles()->count() > 2) {
            $user->perfiles()->delete();
        }

        $user->cuenta_activa = true;
        $user->es_premium = $esPremium;
        $user->save();

        if ($user->perfiles()->count() > 0)
            return redirect('seleccionarPerfil');
        else
            return redirect()->route('perfiles.create');
    }

    public function eliminarSuscripcion() {
        $user = auth()->user();

        $user->cuenta_activa = false;
        $user->es_premium = false;
        $user->save();

        Auth::logout();
        Session::flush();

        return redirect('/');
    }
}
