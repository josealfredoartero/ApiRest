<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'prefix' => 'auth',
], function () {
    Route::get('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::post('productos','ProductoController@all');
    Route::resource('roles', 'RolController');
    Route::resource('user', 'UserController');
});

route::group([
    'prefix' => 'notas',
],
 function(){
    Route::resource('curso','NotasCds\CursoController');
    Route::resource('estudiante','NotasCds\EstudianteController');
    route::put("estudiante/update","NotasCds\EstudianteController@update");
    route::delete("estudiante/delete","NotasCds\EstudianteController@destroy");
    route::post("estudiante/consulta","NotasCds\EstudianteController@estudiante");
    route::resource("modulos","NotasCds\ModuloController");
    // route::resource("nota","NotasCds\NotaController");
    route::resource("cohorte","NotasCds\CohorteController");
    route::resource("actividad","NotasCds\ActividadController");
    // route::get("cursoNivel","NotasCds\Curso_nivelsController@index");
    route::get("curso/cohorte","NotasCds\CursoController@cohorte");
    // route::get("modulos/nivel/{id}","NotasCds\ModuloController@NModulo");
    // route::get('cohorte/nivel/{id}/{id}',"NotasCds\ModuloController@CNivel");
    route::get('nivel','NotasCds\NivelController@index');
    route::get('cohorte/estudiantes/{id}','NotasCds\EstudianteController@estudiantes');
    route::post('modulos/cursos','NotasCds\ModuloController@CNModulo');
    route::post('actividades/modulo','NotasCds\ActividadController@actividades');
    route::post('agregar','NotasCds\NotaController@guardar');
    route::get("notas/estudiante/{id}","NotasCds\EstudianteController@estudianteNota");

 });
