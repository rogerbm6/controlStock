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

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mesa;
use App\MesasProductos;
use App\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MesaFormRequest;
use App\Http\Requests\MesaProductoFormRequest;

class MesasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesas = DB::table('mesas')->orderBy('id')->paginate(4);
        $productos = DB::table('productos')->count();
        //  $venta = DB::table('ventas')->select('precio_venta');
        //dd($venta);
        return view('mesas/index', ['arrayMesas'=>$mesas, 'productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MesaFormRequest $request)
    {
        $id = DB::table('mesas')->insertGetId(
            ['nombre' => $request->input('nombre')]
        );


        if ($request->hasFile('imagen')) {
            if ($request->file('imagen')->isValid()) {
                $imagen = Mesa::findOrFail($id);
                $extension = $request->file('imagen')->extension();
                $imagen->imagen = $id.'.'.$imagen->nombre.'.'.$extension;
                $request->file('imagen')->storeAs(
                  'mesas',
                  $id.'.'.$imagen->nombre.'.'.$extension,
                  ['disk'=>'public']
              );
                $imagen->save();
            }
        }


        return redirect()->action('MesasController@index');
    }

    public function deleteMesa($mesa)
    {
      //Busca la tupla con el producto de esa mesa
        $productosMesa = MesasProductos::where('mesa_id', $mesa)->delete();
        $mesaBorrar=Mesa::findOrFail($mesa);
        Storage::disk('public')->delete('mesas/'.$mesaBorrar->imagen);
        $mesaBorrar->delete();

        return redirect()->action('MesasController@index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //todos los productos para el select de agregar producto
        $allProductos = Producto::orderBy('precio')->get();
        //mesa que se quiere ver
        $mesa = Mesa::find($id);
        //todos los productos de esa mesa
        $productosMesa = MesasProductos::all()->where('mesa_id', $id);
        //array para los productos de la mesa
        $productos = [];
        foreach ($productosMesa as $value) {
            //añade un array con la clave (id del producto) y de valor otro array asociativo [objeto-producto y cantidad]
            $productos+=  [$value->producto_id => ['producto'=>Producto::find($value->producto_id), 'cantidad'=>$value->cantidad]];
        }
        //ordeno el array, para que siempre muestre el mismo orden
        asort($productos);

        return view('mesas/show', ['mesa'=>$mesa, 'productos'=>$productos, 'allProductos' => $allProductos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MesaFormRequest $request)
    {
        $mesaEdit = Mesa::find($request->input('mesa_id'));

        $mesaEdit->nombre = $request->input('nombre');

        if ($request->hasFile('imagen')) {
            if ($request->file('imagen')->isValid()) {
                $extension = $request->file('imagen')->extension();
                //borrar
                Storage::disk('public')->delete('mesas/'.$mesaEdit->imagen);
                //database
                $mesaEdit->imagen = $mesaEdit->id.'.'.$mesaEdit->nombre.'.'.$extension;
                //server
                $request->file('imagen')->storeAs(
                  'mesas',
                  $mesaEdit->id.'.'.$mesaEdit->nombre.'.'.$extension,
                  ['disk'=>'public']
              );
            }
        }


        $mesaEdit->save();
        return redirect()->action('MesasController@index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createProductoMesa(MesaProductoFormRequest $request)
    {
        //crea el objeto
        $nuevo = new MesasProductos();
        //id de producto, sacado en vista
        $nuevo->producto_id = $request->input('producto_id');
        //id de mesa en url y formulario
        $nuevo->mesa_id = $request->input('mesa_id');
        //cantidad y formulario
        $nuevo->cantidad = $request->input('cantidad');
        $nuevo->save();


        return redirect()->action('MesasController@show', ['id'=>$request->input('mesa_id')]);
    }

    public function deleteProductoMesa(Request $request, $mesa)
    {
      //Busca la tupla con el producto de esa mesa
        $productosMesa = MesasProductos::where('mesa_id', $mesa)->where('producto_id', $request->input('producto_id'))->delete();

        return redirect()->action('MesasController@show', ['id'=>$mesa]);
    }


    public function editProductoMesa(MesaProductoFormRequest $request, $id)
    {
      //Busca la tupla con el producto de esa mesa
        $productosMesa = MesasProductos::where('mesa_id', $id)->where('producto_id', $request->input('producto_id'))->first();

        $productosMesa->cantidad = $request->input('cantidad');

        $productosMesa -> save();

        return redirect()->action('MesasController@show', ['id'=>$id]);
    }
}
