<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login/admin');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register/admin');

Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login/admin'); //no se si se pisan estos nombres, igual en el codigo estan puestas las rutas
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register/admin');

//Route::view('/home', 'home')->middleware('auth'); //mejor uso el controlador de arriba, es lo mismo
Route::view('/admin', 'admin')->middleware('auth:admin'); //esto hace que solo los admin puedan acceder
//Route::view('/writer', 'writer')->middleware('auth:writer');; //si quisiera otro tipo de usuario
