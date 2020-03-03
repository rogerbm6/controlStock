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
use PDF;

class ImprimirController extends Controller
{
  public function show()
  {
      //mesas para la vista
      $mesas = Mesa::all();
      $dia=Venta::whereDay('vendido_en', date('d'))->get();
      $totalDia=0;
      foreach ($dia as $value) {
        $totalDia += $value->precio_venta;
      }

      //todos los id de productos en tabla pivote
      $ventas = VentasProductosMesa::all();
      //array para productos
      $productos = [];
      //guarda array de ['productomesa_id'(tabla pivote de venta y productos_mesas)=>['producto', 'cantidad en tabla pivote']]
      //los guarda
      foreach ($ventas as $venta) {
        //busca en otra tabla pivote (MesasProductos) el id que contiene el producto y mesa de nuestro pivote actual
        $producto = MesasProductos::find($venta->productomesa_id);
        //añade al array
        $productos+=["$venta->id"=>['producto'=>Producto::find($producto->producto_id), 'cantidad'=>$venta->cantidad, 'mesa'=>Mesa::find($producto->mesa_id), 'ventaProducto'=>$venta, 'fecha'=>Venta::find($venta->venta_id)]];
      }

      //$pdf = \PDF::loadView('imprimir/show',['productos'=>$productos,'total'=>$totalDia]);

      //return $pdf->download('show.pdf');

      return view('imprimir/show', ['productos'=> $productos, 'total'=>$totalDia]);
  }

  public function mes()
  {
      //mesas para la vista
      $mesas = Mesa::all();
      $dia=Venta::whereMonth('vendido_en', date('m'))->get();
      $totalDia=0;
      foreach ($dia as $value) {
        $totalDia += $value->precio_venta;
      }

      //todos los id de productos en tabla pivote
      $ventas = VentasProductosMesa::all();
      //array para productos
      $productos = [];
      //guarda array de ['productomesa_id'(tabla pivote de venta y productos_mesas)=>['producto', 'cantidad en tabla pivote']]
      //los guarda
      foreach ($ventas as $venta) {
        //busca en otra tabla pivote (MesasProductos) el id que contiene el producto y mesa de nuestro pivote actual
        $producto = MesasProductos::find($venta->productomesa_id);
        //añade al array
        $productos+=["$venta->id"=>['producto'=>Producto::find($producto->producto_id), 'cantidad'=>$venta->cantidad, 'mesa'=>Mesa::find($producto->mesa_id), 'ventaProducto'=>$venta, 'fecha'=>Venta::find($venta->venta_id)]];
      }

      //$pdf = \PDF::loadView('imprimir/show',['productos'=>$productos,'total'=>$totalDia]);

      //return $pdf->download('show.pdf');

      return view('imprimir/show', ['productos'=> $productos, 'total'=>$totalDia]);
  }

  public function ano()
  {
      //mesas para la vista
      $mesas = Mesa::all();
      $dia=Venta::whereYear('vendido_en', date('Y'))->get();
      $totalDia=0;
      foreach ($dia as $value) {
        $totalDia += $value->precio_venta;
      }

      //todos los id de productos en tabla pivote
      $ventas = VentasProductosMesa::all();
      //array para productos
      $productos = [];
      //guarda array de ['productomesa_id'(tabla pivote de venta y productos_mesas)=>['producto', 'cantidad en tabla pivote']]
      //los guarda
      foreach ($ventas as $venta) {
        //busca en otra tabla pivote (MesasProductos) el id que contiene el producto y mesa de nuestro pivote actual
        $producto = MesasProductos::find($venta->productomesa_id);
        //añade al array
        $productos+=["$venta->id"=>['producto'=>Producto::find($producto->producto_id), 'cantidad'=>$venta->cantidad, 'mesa'=>Mesa::find($producto->mesa_id), 'ventaProducto'=>$venta, 'fecha'=>Venta::find($venta->venta_id)]];
      }

      //$pdf = \PDF::loadView('imprimir/show',['productos'=>$productos,'total'=>$totalDia]);

      //return $pdf->download('show.pdf');

      return view('imprimir/show', ['productos'=> $productos, 'total'=>$totalDia]);
  }
}
