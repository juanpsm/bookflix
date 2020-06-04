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
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->middleware('auth:admin')->name('register/admin');

Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('login/admin'); //no se si se pisan estos nombres, igual en el codigo estan puestas las rutas
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register/admin');

//Route::view('/home', 'home')->middleware('auth'); //mejor uso el controlador de arriba, es lo mismo
Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin'); //esto hace que solo los admin puedan acceder
//Route::view('/writer', 'writer')->middleware('auth:writer');; //si quisiera otro tipo de usuario

Route::get('/admin/admins', "AdminsController@index")->middleware('auth:admin');
Route::get('/admin/admins/{admin}', "AdminsController@show")->middleware('auth:admin');
Route::delete('/admin/admins/{admin}', "AdminsController@destroy")->middleware('auth:admin');


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
Route::get('/administrarPerfil', 'PerfilController@administrar')->middleware('auth')->name('administar_perfil');
Route::get('setPerfil/{id}','PerfilController@storeSessionProfile')->name('perfiles.setProfile');

//genero:
Route::resource('generos', 'GeneroController');

//editorial:
Route::resource('editoriales', 'EditorialController');

//autor:
Route::resource('autores', 'AutorController');

//libro:
Route::resource('libros', 'LibroController');
Route::get('libros/user/search', 'LibroController@search');
Route::get('libros/user/{libro}', 'LibroController@showForUser');
Route::get('libros/user/{libro}/toggle_favorite', 'LibroController@toggleFavorite');
Route::get('libros/user/{libro}/toggleMyList', 'LibroController@toggleMyList');



//novedad:
Route::resource('novedades', 'NovedadController');

// Session (test)
Route::get('/session/get','SessionController@getSessionData')->name('session.get');
Route::get('/session/set','SessionController@storeSessionData');
Route::get('/session/remove','SessionController@deleteSessionData');

Route::get('showGenero/{id}','GeneroController@showGenero')->name('generos.showGenero');
Route::get('showNovedad','NovedadController@showNovedad')->name('novedades.showNovedad');

//trailer:
Route::resource('trailers', 'TrailerController');
//historial
Route::resource('libros_leidos', 'LibrosLeidosController');
//favoritos
Route::resource('libros_favoritos', 'LibrosFavoritosController');
//miLista
Route::resource('libros_miLista', 'LibroMiListaController'); //como hizo santi