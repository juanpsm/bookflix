<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
// Agrego los admin
use App\Admin;

use App\Perfil;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// esta libreria usan los admin
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    // intento cambiar la redireccion por defecto a home
    public function redirectTo()
    {   
        $usuarioId = auth()->user()->id;
        $perfiles = Perfil::where('user_id', $usuarioId)->get();
        if ($perfiles->isEmpty()) {
            return route('perfiles.create');
        } else {
            return route('seleccionar_perfil');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['adminValidator', 'showAdminRegisterForm', 'createAdmin']]);
        //agrego los admin, los users se hacen por otro lado
        //$this->middleware('guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'dni' => ['required', 'numeric'],
        ]);
    }

    // el admin valida distintos campos
    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dni' => $data['dni'],
        ]);
    }

    // Esto no se si va, pero crearia la orden de mostrar la pagina de registro de admins..
    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }
    // otros usuarios que no hay: 
    // public function showWriterRegisterForm()
    // {
    //     return view('auth.register', ['url' => 'writer']);
    // }

    protected function createAdmin(Request $request)
    {
        $this->adminValidator($request->all())->validate();//aca no entiendo si llama al validator de mas arriba, tienen distintos campos
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        //return redirect()->intended('login/admin');
        return redirect()->route('admin')->with('mensaje', 'Admin Creado!');
    }

    // Y otros...
    // protected function createWriter(Request $request)
    // {
    //     $this->validator($request->all())->validate();
    //     $writer = Writer::create([
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ]);
    //     return redirect()->intended('login/writer');
    // }
}
