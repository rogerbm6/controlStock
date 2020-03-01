<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MesasProductos;
use App\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductoFormRequest;

class ProductosController extends Controller
{
  public function index()
  {
      $tipos = Producto::distinct('tipo')->get();

      return view('productos/index', ['tipos'=>$tipos]);
  }

  public function show($tipo)
  {
      $productos = Producto::where('tipo', "$tipo")->orderby('precio')->get();

      $total = Producto::where('tipo', "$tipo")->count('id');


      return view('productos/show', ['productos'=>$productos, 'total'=>$total, 'tipo'=> $tipo]);
  }


  public function create(ProductoFormRequest $request)
  {
      $producto = new Producto;

      $producto->nombre = $request->input('nombre');

      $producto->precio = $request->input('precio');

      $producto->tipo   = $request->input('tipo');

      $producto->save();

      return redirect()->action('ProductosController@show', ['tipo'=>$producto->tipo]);
  }

  public function update(ProductoFormRequest $request)
  {
      $producto = Producto::find($request->input('producto_id'));

      $producto->nombre = $request->input('nombre');

      $producto->precio = $request->input('precio');

      $producto->save();

      return redirect()->action('ProductosController@show', ['tipo'=>$producto->tipo]);
  }

  public function destroy(Request $request)
  {
      $producto = Producto::find($request->input('producto_id'));

      $tipo = $producto->tipo;

      $producto->delete();

      return redirect()->action('ProductosController@show', ['tipo'=>$producto->tipo]);
  }

}
