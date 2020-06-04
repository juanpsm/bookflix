<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Auth;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        // Agrego un filtro para que no se pueda eliminar a si mismo el administrador logueado.
        $admins = Admin:: where('id', '!=', Auth::user()->id);
        return view('admins.index', compact('admins'));
    }

    public function destroy(Admin $admin) {
        $admin->delete();
        return back()->with('mensaje', 'Admin Eliminado!');
    }
}
