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
  //inicio de la aplicación
  Route::resource('/home', 'BoardController')->middleware('auth');
  //muestra las mesas solas
  Route::resource('/mesas', 'MesasController')->middleware('auth')->middleware('language');
  //crea una mesa vacia
  Route::post('/mesas/create', 'MesasController@Create')->middleware('auth')->middleware('language');
  //muestra una mesa y sus productos
  Route::get('/mesas/show/{id}', 'MesasController@show')->middleware('auth')->middleware('language');
  //edita un producto de una mesa
  Route::put('/mesas/show/{id}', 'MesasController@editProductoMesa')->middleware('auth')->middleware('language');
  //crea un producto en una mesa
  Route::post('/mesas/createProductoMesa', 'MesasController@createProductoMesa')->middleware('auth')->middleware('language');
  //borra un producto en una mesa
  Route::delete('/mesas/deleteProducto/{mesa}', 'MesasController@deleteProductoMesa')->middleware('auth');
  //borra la mesa y los productos dentro(cascade)
  Route::delete('/mesas/deleteMesa/{mesa}', 'MesasController@deleteMesa')->middleware('auth');
  //actualiza nombre e imagen de mesa
  Route::put('/mesas', 'MesasController@edit')->middleware('auth')->middleware('language');

  //ProductosController
  //muestra categorias
  Route::resource('/productos', 'ProductosController')->middleware('auth')->middleware('language');
  //muestra los productos de una categoria
  Route::get('/productos/{tipo}', 'ProductosController@show')->middleware('auth')->middleware('language');
  //crea producto de una categoria
  Route::post('/productos/create', 'ProductosController@create')->middleware('auth');
  //actualiza producto
  Route::put('/productos/update', 'ProductosController@update')->middleware('auth');
  //elimina producto
  Route::delete('/productos/delete', 'ProductosController@delete')->middleware('auth');

  //VentasController
  //muestra todas las ventas
  Route::resource('/ventas', 'VentasController')->middleware('auth')->middleware('language');
  //crear venta
  Route::post('/ventas/create', 'VentasController@create')->middleware('auth')->middleware('language');
  //actualizar venta
  Route::put('/ventas/{id}', 'VentasController@update')->middleware('auth');
  //eliminar venta
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


  // Registration Routes...
  Route::get('register', function () {
    return view('register/nuevo');
  })->name('register')->middleware('auth');
  Route::post('register', 'BoardController@register')->middleware('auth');


});


Auth::routes(['register'=>false]);



Route::get('/home', 'BoardController@index')->middleware('auth')->name('home');
