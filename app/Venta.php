<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
  protected $fillable =
  [
      'nombre', 'precio' , 'tipo',
  ];


  public function productoMesas()
  {
    return $this->belongsToMany('App\ProductoMesa');
  }
}
