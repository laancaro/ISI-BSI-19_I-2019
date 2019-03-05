<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trabajador extends Model
{
     public $table = "trabajador";
     protected $primaryKey = 'cedula';

      protected $fillable = [
        'nombre', 'cedula','provincia','canton','distrito','direccion','telefono','celular','correo','ocupacion','grado_academico','fecha_nacimiento','banco','num_cuenta_banco'
    ];
}
