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
    Route::resource('cursos','NotasCds\cursosController');
    Route::resource('promocion','NotasCds\promocionController');
    Route::resource('estudiante','NotasCds\EstudianteController');
    Route::post('estudiante/modulos','NotasCds\EstudianteController@modulos');
 });
