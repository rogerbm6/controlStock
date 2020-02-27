<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
  protected $fillable =
  [
      'descuento', 'vendido_en' , 'precio_venta',
  ];


  public function mesasProductos()
  {
    return $this->belongsToMany('App\MesasProductos');
  }
}
