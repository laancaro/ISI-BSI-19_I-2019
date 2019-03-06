<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    public $table = "factura";	
    protected $fillable = [
        'id', 'fecha','moneda', 'tipo_cambio','cliente', 'producto1','producto2','producto3','subtotal','descuento','impuestos','total'
    ];
}
