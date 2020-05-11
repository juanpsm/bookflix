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

Route::resource('tarjetas', 'TarjetaController');
// el recurso genera todas estas rutas
// por ejemplo con
// Route::resource('photos', 'PhotoController'); 
//------------------------------------------------------------
// Verb	        URI                     Action   Route Name
//------------------------------------------------------------
// GET          /photos                 index   photos.index
// GET	        /photos/create	        create  photos.create
// POST	        /photos                 store   photos.store
// GET	        /photos/{photo}         show    photos.show
// GET          /photos/{photo}/edit    edit    photos.edit
// PUT/PATCH    /photos/{photo}	        update  photos.update
// DELETE       /photos/{photo}	        destroy photos.destroy

Route::resource('perfiles', 'PerfilController')->middleware('auth');

Route::get('/seleccionarPerfil', 'PerfilController@selector')->middleware('auth')->name('seleccionar_perfil');

//genero:
Route::resource('generos', 'GeneroController');

//editorial:
Route::resource('editoriales', 'EditorialController');

//autor:
Route::resource('autores', 'AutorController');

//libro:
Route::resource('libros', 'LibroController');

//novedad:
Route::resource('novedades', 'NovedadController');