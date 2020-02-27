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

Route::delete('/mesas/deleteProducto/{mesa}', 'MesasController@deleteProductoMesa');

Route::delete('/mesas/deleteMesa/{mesa}', 'MesasController@deleteMesa');

Route::put('/mesas', 'MesasController@edit');

//ProductosController
Route::resource('/productos', 'ProductosController');

Route::get('/productos/{tipo}', 'ProductosController@show');

Route::post('/productos/create', 'ProductosController@create');

Route::put('/productos/update', 'ProductosController@update');

Route::delete('/productos/delete', 'ProductosController@delete');

//VentasController

Route::resource('/ventas', 'VentasController');

Route::post('/ventas/create', 'VentasController@create');

Route::put('/ventas/{id}', 'VentasController@update');

Route::delete('/ventas/{id}', 'VentasController@destroy');

//VentasProductosMesa

Route::get('/ventas/productos/{id}', 'VentasProductosController@show');

Route::get('/ventas/productos/{venta}/add/{mesa}', 'VentasProductosController@mesa');

Route::post('/ventas/productos/{venta}/add/{mesa}', 'VentasProductosController@create');
