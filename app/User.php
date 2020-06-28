<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dni',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tarjetas()
    {
        return $this->hasMany('App\Tarjeta');
        // con esto le digo que tiene muchas tarjetas 
        // Si quisiera solo una
        //
        // return $this->hasMany('App\Tarjeta');
        //
        // luego puedo acceder a la misma con
        // $tarjeta = User::find(1)->tarjeta;
    }
    
    public function perfiles()
    {
        return $this->hasMany('App\Perfil');
        // luego puedo acceder con
        // $perfiles = App\Post::find(1)->perfiles;
        //
        // foreach ($perfiles as $perfil) {
        //     //
        // }
        // Y tambien encadenar condiciones, por ej
        // $perfil = App\Post::find(1)->perfiles()->where('name', 'foo')->first();
    }
    /**
     * Getter para fecha de creacion del registro
     *
     * @return string
     */
    public function getCreationDate()
    {
        return "{$this->created_at->format('d/m/Y')} a las {$this->created_at->format('H:i:s')}";
    }
}
