<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable =
  [
      'nombre',
  ];

  public function users()
  {
    return $this->belongsToMany('App\User');
  }

  public function productos()
  {
    return $this->belongsToMany('App\Producto')->withPivot('cantidad');
  }
}
