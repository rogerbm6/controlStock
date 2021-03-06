<?php
/* Copyright (c) 2020 <YOUR NAME>

GNU GENERAL PUBLIC LICENSE
   Version 3, 29 June 2007

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>. */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mesa;
use App\Producto;
use App\Venta;
use App\MesasProductos;
use App\VentasProductosMesa;
use App\Http\Requests\VentaProductoFormRequest;

class VentasProductosController extends Controller
{
  public function show($id)
  {
      //mesas para la vista
      $mesas = Mesa::all();
      //venta con porcentaje y total
      $ventaOriginal=Venta::find($id);
      //todos los id de productos en tabla pivote
      $ventas = VentasProductosMesa::where('venta_id',$id)->get();
      //array para productos
      $productos = [];
      //añade al array [id_productomesa=>['producto'=>obletoProducto, 'cantidad'=>cantidad(VentasProductosMesa), 'mesa'=>objetoMesa, 'ventaProducto'=>objetoVentasProductosMesa]]
      //los guarda
      foreach ($ventas as $venta) {
        //busca en otra tabla pivote (MesasProductos) el id que contiene el producto y mesa de nuestro pivote actual
        $producto = MesasProductos::find($venta->productomesa_id);
        $productos+=["$venta->productomesa_id"=>['producto'=>Producto::find($producto->producto_id), 'cantidad'=>$venta->cantidad, 'mesa'=>Mesa::find($producto->mesa_id), 'ventaProducto'=>$venta]];
      }

/*------cambia el precio total con el descuento-------*/
      //Suma los precios y les resta el porcentaje de descuento
      $precios =0;
        //recorre todos los productos de la venta y suma sus precios
        for ($i=0; $i < count($ventas); $i++) {
          //busca el id del producto en la tabla pivote MesasProductos
          $idProductoMesa = MesasProductos::find($ventas[$i]->productomesa_id);
          //busca y suma los precios en la tabla productos
          $precioProducto = Producto::find($idProductoMesa->producto_id);
          //precio multiplicado por cantidad
          $precios += (($precioProducto->precio)*($ventas[$i]->cantidad));
        }

        //el valor del descueto
        $descuento = ($precios * $ventaOriginal->porcentaje)/100;

        $ventaOriginal->precio_venta = $precios-$descuento;


      $ventaOriginal->save();

      return view('ventas/show', ['productos'=> $productos, 'venta'=>$ventaOriginal, 'mesas'=>$mesas]);
  }

  public function mesa($venta, $mesa)
  {
      $productosMesa = MesasProductos::all()->where('mesa_id', $mesa);

      $mesas = Mesa::find($mesa);

      $venta = Venta::find($venta);

      $productos = [];

      foreach ($productosMesa as $value) {
          //añade un array con la clave (id del producto) y de valor otro array objeto producto y cantidad
          $productos+=  [$value->producto_id => ['producto'=>Producto::find($value->producto_id), 'cantidad'=>$value->cantidad]];
      }

      asort($productos);

      return view('ventas/mesa', ['productos'=> $productos, 'venta'=>$venta, 'mesa'=>$mesas]);
  }


  public function create($venta, $mesa, VentaProductoFormRequest $request)
  {
    //Busca la pivote de mesa y producto, y le resta la cantidad
      $productoMesa = MesasProductos::where('mesa_id', $mesa)->where('producto_id', $request->input('producto_id'))->first();

      //evita que se venda algo que ya lo está, lo busca y si está devuelve un objeto

      $vendido = VentasProductosMesa::where('venta_id',$venta)->where('productomesa_id', $productoMesa->id)->first();

      //comprueba el objeto o si la cantidad es 0
      if (is_object($vendido) || ($productoMesa->cantidad == 0 )||($request->input('cantidad')>$productoMesa->cantidad)) {

        return redirect()->action('VentasProductosController@show', ['id'=>$venta]);
      }

      $productoMesa->cantidad -= $request->input('cantidad');

      $productoMesa->save();
      /*-----------*/
      //crea el nuevo objeto pivote de venta con el otro pivote
      $productoAdd = new VentasProductosMesa;
      //agrega la cantidad
      $productoAdd->cantidad = $request->input('cantidad');
      //añade id de MesasProductos
      $productoAdd->productomesa_id = $productoMesa->id;
      //añade el id de la venta (está en la URL)
      $productoAdd->venta_id = $venta;

      $productoAdd->save();
      /*--------------*/


      return redirect()->action('VentasProductosController@show', ['id'=>$venta]);
  }

  public function update(VentaProductoFormRequest $request, $venta)
  {
      $venta = VentasProductosMesa::find($request->input('ventaProducto'));
      //variable que guarda la diferencia de la cantidad
      $diferencia = $venta->cantidad - $request->input('cantidad');


      //Busca la pivote de mesa y producto, y le resta la cantidad
      $productoMesa = MesasProductos::where('id', $venta->productomesa_id)->first();
      //comprueba si está aumentando la cantidad
      if ($request->input('cantidad') > $venta->cantidad) {
        //comprueba el objeto o si la cantidad es 0 para que no sume a la cantidad si no hay en la mesa
        if (($productoMesa->cantidad == 0 )||($request->input('cantidad') > $productoMesa->cantidad)) {

          return redirect()->action('VentasProductosController@show', ['id'=>$venta]);
        }
      }


      $venta->cantidad=$request->input('cantidad');

      $venta->save();

      //busca el registro para cambiar la cantidad
      $productoASumar = MesasProductos::find($venta->productomesa_id);

      $productoASumar->cantidad += $diferencia;
      $productoASumar->save();

      return redirect()->action('VentasProductosController@show', ['id'=>$venta->venta_id]);
  }

  public function destroy(Request $request, $venta)
  {
      $ventas = VentasProductosMesa::find($request->input('ventaProducto'));
      //cantidad para sumar en el inventario
      $cantidadSumar = $ventas->cantidad;
      //busca el registro para sumar la cantidad eliminada
      $productoASumar = MesasProductos::find($ventas->productomesa_id);

      $ventas->delete();
      //suma la cantidad
      $productoASumar->cantidad += $cantidadSumar;

      $productoASumar->save();

      return redirect()->action('VentasProductosController@show', ['id'=>$venta]);
  }
}
