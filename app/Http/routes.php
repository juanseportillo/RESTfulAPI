<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

<<<<<<< HEAD
Route::get('/', 'VehiculoController@showAll');asdas
Route::resource('fabricantes','FabricanteController');
Route::resource('fabricantes.vehiculos','VehiculoController');
=======
Route::get('/', 'MyController@index');
>>>>>>> parent of 0d80220... Se crean las primeras rutas y controladores
