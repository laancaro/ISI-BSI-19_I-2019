<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	 public $table = "producto";	
     protected $fillable = [
        'nombre', 'tipo','descripcion','costo_unitario'
    ];
}
