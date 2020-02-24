<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MesasProductos extends Model
{
  protected $fillable =
  [
      'producto_id', 'mesa_id' , 'cantidad',
  ];


  public function ventas()
  {
    return $this->belongsToMany('App\Venta');
  }
}
