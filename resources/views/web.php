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


Route::get('/home', 'Familiar@index')->name('home');
Route::get('envia1/{id}', 'Familiar@crea_correo')->name('envia1');
Route::get('prueba','Familiar@prueba');
// Idiomas
Route::any('idioma/{lan}', 'Familiar@idioma')->name('idioma');



Route::get('ver_proyectos', 'Familiar@index')->name('ver_proyectos');
Route::get('administrar/crear_unidades', 'Familiar@crear_unidades');
Route::post('administrar/crear_unidades', 'Familiar@guardar_unidades');
Route::get('administrar/ver_unidades', 'Familiar@ver_unidades');
Route::get('administrar/crear_roles', 'Familiar@crear_roles');
Route::post('administrar/crear_roles', 'Familiar@guardar_roles');
Route::get('administrar/ver_roles', 'Familiar@ver_roles');
Route::get('proyectos/crear', 'Familiar@create')->name('proyectos.crear');
Route::post('proyectos/crear', 'Familiar@store');
Route::get('proyectos/actividades', 'Familiar@crear_actividades');
Route::post('proyectos/actividades', 'Familiar@guardar_actividades');
Route::get('ver_actividades/{proyecto_id}', 'Familiar@ver_actividades')->name('ver_actividades');
Route::any('inserta_actividad/{id}/{proyecto_id}','Familiar@editar_actividad')->name('inserta_activdad');

Route::get('listaproyectos', 'Familiar@index');
Route::get('editar_actividad/{id}/{proyecto_id}', 'Familiar@editar_actividad');


/* Route::get('envia_correo', 'Familiar@crea_mensaje'); */
Route::post('envia_correo', 'Familiar@envia_correo')->name('envia_correo');
Route::any('recibe_invitacion', 'Auth\RegisterController@showRegistrationForm');
Route::any('acepta_invitacion/{proyecto_id}','Familiar@acepta_invitacion')->name('acepta_invitacion');

Route::get('muestraproyecto', function(){
    $proyectos = Proyecto::all()->first();
    echo $proyectos->nombre;
});
Route::get('muestraactividad', function(){
    $actividades = Actividad::all();
    echo $actividades[0]->nombre;
});

