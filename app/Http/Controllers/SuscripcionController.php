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

        // if ($user->cuenta_activa) {
        //     return redirect('/home');
        // }

        return view('suscripciones.index', ['user' => $user]);
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

        // Validator::extend('card_number', function($attribute, $value, $parameters, $validator) {
        //     $number = str_replace(' ', '', $value);
        //     return ($number % 10 !== 1) && strlen($number) >= 15 && strlen($number) <= 16;
        // });

        $vData = $request->validate([
            'tipoCuenta' => '',
            'card-number' => 'required|string',
            'card-name' => 'required|string',
            'card-expiry' => 'required|string|card_expiry',
            'card-cvc' => 'required|numeric',
        ]);

        $number = str_replace(' ', '', $vData['card-number']);

        if (strlen($number) < 15 || strlen($number) > 16) {
            return redirect()->back()->withErrors([
                'msg' => 'El numero de la tarjeta de credito debe tener entre 15 y 16 digitos'
            ]);
        }

        if (strlen($number . $vData['card-cvc']) !== 19) {
            return redirect()->back()->withErrors([
                'msg' => 'La tarjeta fue rechazada. Verifique los datos ingresados'
            ]);
        }

        if ($number % 10 === 1) {
            return redirect()->back()->withErrors([
                'msg' => 'La tarjeta fue rechazada'
            ]);
        }

        if (isset($vData['tipoCuenta'])) {
            if ($number % 10 === 2) {
                return redirect()->back()->withErrors([
                    'msg' => 'La tarjeta no tiene saldo suficiente'
                ]);
            }

            $esPremium = $vData['tipoCuenta'] == 'premium';
            
            if (!$esPremium && $user->perfiles()->count() > 2) {
                $user->perfiles()->delete();
            }

            $user->ultimo_cobro = Carbon::now();
        }

        $user->cuenta_activa = true;
        if (isset($vData['tipoCuenta']))
            $user->es_premium = $esPremium;
        $user->tarjeta_numero = $number;
        $user->tarjeta_nombre = $vData['card-name'];
        $user->tarjeta_expiracion = $vData['card-expiry'];
        $user->tarjeta_cvc = $vData['card-cvc'];

        $user->save();

        if (!isset($vData['tipoCuenta']))
            return redirect('home');
        else if ($user->perfiles()->count() > 0)
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
