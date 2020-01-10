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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('persona/tipos-documentos', 'PersonaController@obtenerTiposDocumentos');
    Route::get('persona/obtener/{cedula}', 'PersonaController@obtenerPersona');
    Route::get('persona/todos', 'PersonaController@personas');
    Route::post('persona/editar', 'PersonaController@editar');
    Route::put('persona/nueva', 'PersonaController@nuevo');
    Route::delete('persona/eliminar/{cedula}', 'PersonaController@eliminar');
});
