<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    public $table = "receta";
	protected $fillable = [
	'id', 'persona', 'medicamento', 'cantidad', 'usuario', 'fecha_entrega'
	];
}
