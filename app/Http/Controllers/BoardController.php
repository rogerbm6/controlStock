<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Mesa;
use App\Producto;
use App\Venta;
use App\MesasProductos;

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

}
