<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Carbon\Carbon;

class EfectuarCobroController extends Controller
{    
    public function index() {
        $users = User::where('cuenta_activa', true)
            ->get();

        $ok = [];
        $err = [];

        foreach($users as $user) {
            $expiry = explode('/', str_replace(' ', '', $user->tarjeta_expiracion));
            $expiry = Carbon::createFromDate(2000 + $expiry[1], $expiry[0], 1);
            if (Carbon::now()->isAfter($expiry)) {
                array_push($err, "{$user->email}: tarjeta de credito vencida");
                $user->cuenta_activa = false;
                $user->save();
                continue;
            }

            if ($user->tarjeta_numero % 10 === 2) {
                array_push($err, "{$user->email}: tarjeta de credito sin saldo suficiente");
                $user->cuenta_activa = false;
                $user->save();
                continue;
            }

            array_push($ok, "{$user->email}: cobro ok");
        }

        return view('cobros.index', [
            'ok' => $ok,
            'err' => $err,
        ]);
    }
}
