<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Mesa;
use App\Producto;
use App\Venta;
use App\MesasProductos;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistroFormRequest;
use Illuminate\Support\Str;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $anio=Venta::whereYear('vendido_en', date('Y'))->get();
      $mes=Venta::whereMonth('vendido_en', date('m'))->get();
      $dia=Venta::whereDay('vendido_en', date('d'))->get();
      $totalAnio=0;
      $totalMes=0;
      $totalDia=0;
      foreach ($anio as $value) {
        $totalAnio += $value->precio_venta;
      }
      foreach ($mes as $value) {
        $totalMes += $value->precio_venta;
      }
      foreach ($dia as $value) {
        $totalDia += $value->precio_venta;
      }

      $mesas = Mesa::all();
      $productos = MesasProductos::sum('cantidad');
    //  $venta = DB::table('ventas')->select('precio_venta');
      //dd($venta);
      return view('board/index', ['arrayMesas'=>$mesas, 'productos'=>$productos, 'ano'=>$totalAnio,'mes'=>$totalMes,'dia'=>$totalDia]);
    }

    public function register(RegistroFormRequest $request)
    {
      if ($request->input('password')==$request->input('password_confirmation'))
      {
        $usuario = new User;
        $usuario->name= $request->input('name');
        $usuario->email=$request->input('email');
        $usuario->password=Hash::make($request->input('password'));
        $usuario->remember_token = Str::random(10);
        $usuario->save();
      }

      return redirect()->action('BoardController@index');
    }

}
