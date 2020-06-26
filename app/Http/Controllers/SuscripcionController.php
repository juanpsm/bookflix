<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
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

        Validator::extend('card_expiry', function($attribute, $value, $parameters, $validator) {
            $expiry = explode('/', str_replace(' ', '', $value));
            if ($expiry[0] > 12 || $expiry[0] < 1)
                return false;
            $expiry = Carbon::createFromDate(2000 + $expiry[1], $expiry[0], 1);
            return Carbon::now()->isBefore($expiry);
        });

        Validator::extend('card_number', function($attribute, $value, $parameters, $validator) {
            $number = str_replace(' ', '', $value);
            return ($number % 2 === 0) && strlen($number) >= 15 && strlen($number) <= 16;
        });

        $vData = $request->validate([
            'tipoCuenta' => 'required',
            'card-number' => 'required|string|card_number',
            'card-name' => 'required|string',
            'card-expiry' => 'required|string|card_expiry',
            'card-cvc' => 'required|numeric',
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
        
        // 'tarjeta_numero' => str_replace(' ', '', $data['card-number']),
        // 'tarjeta_nombre' => $data['card-name'],
        // 'tarjeta_expiracion' => str_replace(' ', '', $data['card-expiry']),
        // 'tarjeta_cvc' => $data['card-cvc'],
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
