<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    public $table = "personas";	
     protected $fillable = [
        'cedula', 'nombre','apellidos','fecha_nacimiento'
    ];
}
