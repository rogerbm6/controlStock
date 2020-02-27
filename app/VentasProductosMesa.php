<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasProductosMesa extends Model
{
    protected $fillable =
    [
        'venta_id', 'productomesa_id' , 'cantidad',
    ];

}
