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

Route::get('/', function () {
    return view('/auth/login');
});


Auth::routes(['verify' => 'true']);

Route::group(['middleware' => 'verified'], function () {

  Route::resource('/home', 'BoardController')->middleware('auth');

  Route::resource('/mesas', 'MesasController')->middleware('auth')->middleware('language');

  Route::post('/mesas/create', 'MesasController@Create')->middleware('auth')->middleware('language');

  Route::get('/mesas/show/{id}', 'MesasController@show')->middleware('auth')->middleware('language');

  Route::put('/mesas/show/{id}', 'MesasController@editProductoMesa')->middleware('auth')->middleware('language');

  Route::post('/mesas/createProductoMesa', 'MesasController@createProductoMesa')->middleware('auth')->middleware('language');

  Route::delete('/mesas/deleteProducto/{mesa}', 'MesasController@deleteProductoMesa')->middleware('auth');

  Route::delete('/mesas/deleteMesa/{mesa}', 'MesasController@deleteMesa')->middleware('auth');

  Route::put('/mesas', 'MesasController@edit')->middleware('auth')->middleware('language');

  //ProductosController
  Route::resource('/productos', 'ProductosController')->middleware('auth')->middleware('language');

  Route::get('/productos/{tipo}', 'ProductosController@show')->middleware('auth')->middleware('language');

  Route::post('/productos/create', 'ProductosController@create')->middleware('auth');

  Route::put('/productos/update', 'ProductosController@update')->middleware('auth');

  Route::delete('/productos/delete', 'ProductosController@delete')->middleware('auth');

  //VentasController

  Route::resource('/ventas', 'VentasController')->middleware('auth')->middleware('language');

  Route::post('/ventas/create', 'VentasController@create')->middleware('auth')->middleware('language');

  Route::put('/ventas/{id}', 'VentasController@update')->middleware('auth');

  Route::delete('/ventas/{id}', 'VentasController@destroy')->middleware('auth');

  //VentasProductosMesa
  //ver todos los productos
  Route::get('/ventas/productos/{id}', 'VentasProductosController@show')->middleware('auth')->middleware('language');
  //ver los productos de la mesa
  Route::get('/ventas/productos/{venta}/add/{mesa}', 'VentasProductosController@mesa')->middleware('auth')->middleware('language');
  //agregar nuevo producto
  Route::post('/ventas/productos/{venta}/add/{mesa}', 'VentasProductosController@create')->middleware('auth');
  //actualiza la cantidad del producto
  Route::put('/ventas/productos/{venta}', 'VentasProductosController@update')->middleware('auth');
  //elimina el registro de la tabla pivote
  Route::delete('/ventas/productos/{venta}', 'VentasProductosController@destroy')->middleware('auth');

  Route::get('logout', 'Auth\LoginController@logout');


  //ImprimirControll dia
  Route::get('/imprimirDia', 'ImprimirController@show')->middleware('auth');
  //ImprimirControll
  Route::get('/imprimirMes', 'ImprimirController@mes')->middleware('auth');
  //ImprimirControll
  Route::get('/imprimirAno', 'ImprimirController@ano')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'BoardController@index')->middleware('auth')->name('home');
