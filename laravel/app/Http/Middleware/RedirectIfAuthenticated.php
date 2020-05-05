<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Agrego una redirección si se autentica un admin
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        // y si hubiera otro tipo de usuario
        // if ($guard == "writer" && Auth::guard($guard)->check()) {
        //     return redirect('/writer');
        // }

        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
