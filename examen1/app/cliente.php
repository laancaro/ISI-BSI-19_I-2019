<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
	 public $table = "cliente";	
    protected $fillable = [
        'nombre', 'tipo','identificacion', 'direccion','contacto', 'telefono','correo'
    ];
}
