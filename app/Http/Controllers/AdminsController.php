<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        return view('admins.index', [
            'admins' => Admin::all(),
        ]);
    }

    public function destroy(Admin $admin) {
        $admin->delete();
        return back()->with('mensaje', 'Admin Eliminado!');
    }
}
