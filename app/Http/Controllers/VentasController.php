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

use Illuminate\Support\Facades\DB;
use App\Mesa;
use App\Producto;
use App\Venta;
use App\MesasProductos;
use App\VentasProductosMesa;
use App\Http\Requests\VentaFormRequest;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = Venta::whereMonth('vendido_en', date('m'))->orderby('vendido_en', 'desc')->get();

        return view('ventas/index', ['ventas'=>$ventas]);
    }

    public function create(VentaFormRequest $request)
    {
        $venta = new Venta;

        $venta->porcentaje=$request->input('porcentaje');

        $venta->precio_venta=0;

        $venta->vendido_en=date('Y-m-d H:i:s');

        $venta->save();

        return redirect()->action('VentasController@index');
    }

    public function update(VentaFormRequest $request, $id)
    {
        $venta = Venta::find($id);

        $venta->porcentaje = $request->input('porcentaje');

        /*--------------*/
        //Suma los precios y les resta el porcentaje de descuento
        $preciosProd =VentasProductosMesa::where('venta_id', $id)->get();
        $precios =0;
        //recorre todos los productos de la venta y suma sus precios
        for ($i=0; $i < count($preciosProd); $i++) {
          //busca el id del producto en la tabla pivote MesasProductos
          $idProductoMesa = MesasProductos::find($preciosProd[$i]->productomesa_id);
          //busca y suma los precios en la tabla productos
          $precioProducto = Producto::find($idProductoMesa->producto_id);
          $precios += (($precioProducto->precio)*($preciosProd[$i]->cantidad));
        }

        //el valor del descueto
        $descuento = ($precios * $venta->porcentaje)/100;

        $venta->precio_venta = $precios-$descuento;

        $venta->save();

        return redirect()->action('VentasController@index');
    }

    public function destroy(Request $request, $id)
    {
      //todos los registros de la tabla pivote de ventas y MesasProductos
        $ventasProductos = VentasProductosMesa::where('venta_id',$id)->get();
        //elimina todos los registros
        foreach ($ventasProductos as $value) {
          $value->delete();
        }

        $venta = Venta::find($id);

        $venta->delete();

        return redirect()->action('VentasController@index');
    }
}
