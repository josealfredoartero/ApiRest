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
    route::get("notas","NotasCds\NotaController@index");
    Route::get('estudiante','NotasCds\EstudianteController@index');
    Route::post('estudiante','NotasCds\EstudianteController@store');
    route::put("estudiante/update","NotasCds\EstudianteController@update");
    route::delete("estudiante/delete","NotasCds\EstudianteController@destroy");
    route::post("estudiante/consulta","NotasCds\EstudianteController@estudiante");
    route::resource("modulos","NotasCds\ModuloController");
    route::get("cohorte","NotasCds\CohorteController@index");
    route::post("cohorte","NotasCds\CohorteController@store");
    route::resource("actividad","NotasCds\ActividadController");
    route::post("cohortes","NotasCds\CohorteController@CohorteCurso");
    route::post("curso/cohorte","NotasCds\CursoController@cohorte");
    // route::get("modulos/nivel/{id}","NotasCds\ModuloController@NModulo");
    // route::get('cohorte/nivel/{id}/{id}',"NotasCds\ModuloController@CNivel");
    route::get('nivel','NotasCds\NivelController@index');
    route::get('cohorte/estudiantes','NotasCds\EstudianteController@estudiantes');
    route::post('modulos/cursos','NotasCds\ModuloController@CNModulo');
    route::post('actividades/modulo','NotasCds\ActividadController@actividades');
    route::post('agregar','NotasCds\NotaController@guardar');
    route::post("estudiantes/notas","NotasCds\EstudianteController@estudianteNota");
    route::post("modulo/notas","NotasCds\ModuloController@NotasModulo");
    route::Post("userEstudiante","NotasCds\EstudianteController@estudianteUser");
    //mopdificar nota individual
    route::post("ModificarNota","NotasCds\NotaController@modificar");
    //notas de los estudiantes para modificar
    route::post("estudiantesnotas","NotasCds\NotaController@estudiantesnotas");
    //modificar las notas de todos los estudiantes
    route::post("modificarNotas","NotasCds\NotaController@ModificarNotas");
    //listado de todos los estudiantes
    route::Post("listaEstudiantes","NotasCds\EstudianteController@listaEstudiantes");
    //mostrar un estudiante
    route::Post("mostrarEstudiante","NotasCds\EstudianteController@UnEstudiante");

 });
