<?php
use PhpParser\Node\Scalar\MagicConst\Namespace_;

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

use App\Proyecto;
use App\Actividad;
use App\Roll;
Route::get('/', function () {
    return view('inicio');
});

Route::get('inicio', function () {
        return view('inicio');
    })->name('inicio');

Auth::routes();
Route::group(['prefix' => 'auth'], function () {
    Route::get('/{provider}', 'App\Http\Controllers\Auth\LoginController@redirectToProvider');
    Route::get('/{provider}/callback', 'App\Http\Controllers\Auth\LoginController@handleProviderCallback');
});
Route::post('tokensignin', 'App\Http\Controller\Familiar@tokensignin')->name('tokensignin');
Route::get('/home', 'App\Http\Controllers\Familiar@index')->name('home');
Route::get('envia1/{id}', 'App\Http\Controllers\Familiar@crea_correo')->name('envia1');
Route::get('prueba','App\Http\Controllers\Familiar@prueba');
// Idiomas
Route::any('idioma/{lan}', 'App\Http\Controllers\Familiar@idioma')->name('idioma');
Route::any('politica', function(){
	view('politica_confidencialidad');
});
// Ruta temporal para prueba con Google Home
Route::any('lampara', 'Familiar@lampara')->name('lampara');
Route::any('estado_lampara', 'Familiar@estado_lampara')->name('estado_lampara');
// Fin ruta temporal


Route::get('ver_proyectos', 'App\Http\Controllers\amiliar@index')->name('ver_proyectos');
Route::get('administrar/crear_unidades', 'App\Http\Controllers\Familiar@crear_unidades');
Route::post('administrar/crear_unidades', 'App\Http\Controllers\Familiar@guardar_unidades');
Route::get('administrar/ver_unidades', 'App\Http\Controllers\Familiar@ver_unidades');
Route::get('administrar/crear_roles', 'App\Http\Controllers\Familiar@crear_roles');
Route::post('administrar/crear_roles', 'App\Http\Controllers\Familiar@guardar_roles');
Route::get('administrar/ver_roles', 'App\Http\Controllers\Familiar@ver_roles');
Route::get('proyectos/crear', 'App\Http\Controllers\Familiar@create')->name('proyectos.crear');
Route::post('proyectos/crear', 'App\Http\Controllers\Familiar@store');
// Route::get('proyectos/actividades', 'Familiar@crear_actividades');
Route::post('proyectos/actividades', 'App\Http\Controllers\Familiar@guardar_actividades');
Route::get('ver_actividades/{proyecto_id}', 'App\Http\Controllers\Familiar@ver_actividades')->name('ver_actividades');
Route::any('inserta_actividad/{id}/{proyecto_id}','App\Http\Controllers\Familiar@editar_actividad')->name('inserta_activdad');

Route::get('listaproyectos', 'App\Http\Controllers\Familiar@index');
Route::get('editar_actividad/{id}/{proyecto_id}', 'App\Http\Controllers\Familiar@editar_actividad');


/* Route::get('envia_correo', 'App\Http\Controllers\Familiar@crea_mensaje'); */
Route::post('envia_correo', 'App\Http\Controllers\Familiar@envia_correo')->name('envia_correo');
Route::any('recibe_invitacion', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm');
Route::any('acepta_invitacion/{proyecto_id}','App\Http\Controllers\Familiar@acepta_invitacion')->name('acepta_invitacion');

Route::get('muestraproyecto', function(){
    $proyectos = Proyecto::all()->first();
    echo $proyectos->nombre;
});
Route::get('muestraactividad', function(){
    $actividades = Actividad::all();
    echo $actividades[0]->nombre;
});

