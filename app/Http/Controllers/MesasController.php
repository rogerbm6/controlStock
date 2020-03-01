<?php

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
        $allProductos = Producto::orderBy('precio')->get();

        $mesa = Mesa::find($id);
        //coge productos de esa mesa
        $productosMesa = MesasProductos::all()->where('mesa_id', $id);
        //array para los productos de la mesa
        $productos = [];
        foreach ($productosMesa as $value) {
            //añade un array con la clave (id del producto) y de valor otro array objeto producto y cantidad
            $productos+=  [$value->producto_id => ['producto'=>Producto::find($value->producto_id), 'cantidad'=>$value->cantidad]];
        }
        //dd($productosMesa);
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
        $nuevo = new MesasProductos();
        $nuevo->producto_id = $request->input('producto_id');
        $nuevo->mesa_id = $request->input('mesa_id');
        $nuevo->cantidad = $request->input('cantidad');
        //dd($nuevo);
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
