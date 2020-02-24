<?php

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

Route::resource('/', 'BoardController');

Route::resource('/mesas', 'MesasController');

Route::post('/mesas/create', 'MesasController@Create');

Route::get('/mesas/show/{id}', 'MesasController@show');

Route::put('/mesas/show/{id}', 'MesasController@editProductoMesa');

Route::post('/mesas/createProductoMesa', 'MesasController@createProductoMesa');

Route::delete('/mesas/delete/{mesa}', 'MesasController@deleteProductoMesa');
