<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable =
     [
         'nombre', 'precio' , 'tipo',
     ];


    public function mesas()
    {
      return $this->belongsToMany('App\Mesa')->withPivot('cantidad');
    }
}
