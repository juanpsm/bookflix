<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;

class EfectuarCobroController extends Controller
{    
    public function index() {
        $fecha_cobro = Carbon::now()->startOfMonth();

        $users = User::where('cuenta_activa', true)
            ->where(function($query) use ($fecha_cobro) {
                $query->whereNull('ultimo_cobro')
                    ->orWhere('ultimo_cobro', '<', $fecha_cobro->format('Y-m-d'));
            })
            ->get();

        $ok = [];
        $err = [];

        foreach($users as $user) {
            $number = str_replace(' ', '', $user->tarjeta_numero);
            $expiry = explode('/', str_replace(' ', '', $user->tarjeta_expiracion));
            $expiry = Carbon::createFromDate(2000 + $expiry[1], $expiry[0], 1);
            if (Carbon::now()->isAfter($expiry)) {
                array_push($err, "{$user->email}: <span class=\"text-danger\">tarjeta de credito vencida</span>");
                $user->cuenta_activa = false;
                $user->save();
                continue;
            }

            if ($number % 10 === 2) {
                array_push($err, "{$user->email}: <span class=\"text-danger\">tarjeta de credito sin saldo suficiente</span>");
                $user->cuenta_activa = false;
                $user->save();
                continue;
            }

            if ($number % 10 === 1) {
                array_push($err, "{$user->email}: <span class=\"text-danger\">la tarjeta de credito fue rechazada</span>");
                $user->cuenta_activa = false;
                $user->save();
                continue;
            }

            $user->ultimo_cobro = $fecha_cobro;
            $user->save();

            array_push($ok, "{$user->email}: <span class=\"text-success\">cobro ok</span>");
        }

        return view('cobros.index', [
            'ok' => $ok,
            'err' => $err,
        ]);
    }
}
